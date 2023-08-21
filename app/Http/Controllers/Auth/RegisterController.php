<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Client;
use App\Models\ClientVerify;
use App\Models\Status;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Client::class],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $client = Client::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'status' => 'active',
        ]);
        $expirationTime = now()->addMinutes(15);
        $request->session()->put('client_id', $client->id , $expirationTime);
        $token = Str::random(64);
        ClientVerify::create([
            'client_id' => $client->id, 
            'token' => $token
        ]);
        try {
            Mail::send('email.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->sender(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->to($request->email);
                $message->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->subject('Email Verification Mail');
                $message->priority(1);
                //$message->attach('pathToFile');
            });
        } catch (\Exception $e) {
            if ($e->getMessage()) {
                return back()->with('custom_alert', ['type' => 'worning', 'title' => 'Something went wrong.', 'message' => 'Please try again later.']);
            }
        }

        return redirect()->route('verification.notice');
    }


    public function verifyClient($token){
        $verifyClient = ClientVerify::where('token', $token)->first();
  
        $message = "The link you are trying to access has expired. Please request a new link.";
        $type='worning';
        $title='Sorry expired link';
        $updatedTime = Carbon::parse($verifyClient->updated_at);
        $currentTime = Carbon::now();

        if(!is_null($verifyClient) && $currentTime->diffInMinutes($updatedTime) < 10 ){
            $client = $verifyClient->client;
              
            if(!$client->is_email_verified) {
                $verifyClient->client->email_verified_at = Carbon::now();
                $verifyClient->client->is_email_verified = 1;
                $verifyClient->client->save();
                $message = "Your e-mail is verified. You can now login.";
                $type='success';
                $title='e-mail verification';
                $verifyClient->delete();
            } else {
                $message = "Your e-mail is already verified. You can now login.";
                $type='Info';
                $title='e-mail verification';
            }
        }
  
      return redirect()->route('showLoginForm')->with('custom_alert', ['type' => $type, 'title' => $title, 'message' => $message]);
    }

    public function verificationSend()  {
        $client_id = session('client_id');
        $client = Client::findOrFail($client_id);
        $clientVerify = ClientVerify::where('client_id', $client->id)->first();
        $token = Str::random(64);
        $clientVerify->token = $token ;
        $clientVerify->save();
        try {
            Mail::send('email.emailVerificationEmail', ['token' => $token], function ($message) use ($client) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->sender(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->to($client->email);
                $message->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->subject('Email Verification Mail');
                $message->priority(1);
                //$message->attach('pathToFile');
            });
        } catch (\Exception $e) {
            if ($e->getMessage()) {
                return back()->with('custom_alert', ['type' => 'worning', 'title' => 'Something went wrong.', 'message' => 'Please try again later.']);
            }
        }

        return back()->with('custom_alert', ['type' => 'success', 'title' => 'Verification link sent!', 'message' => 'A new verification link has been sent to the email address you provided during registration.']); 
    }


}
