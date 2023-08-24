<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected function guard()
    {
        return Auth::guard('client');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        // dd(Auth::guard('client')->attempt($credentials));
        if (Auth::guard('client')->attempt($credentials)) {
            // Authentication passed...
            if (!empty(json_decode(request()->cookie('cart'))[0]) ) {
                return redirect()->route('show-Details')->with('custom_alert', ['type' => 'success', 'title' => 'Logged in!', 'message' => 'You have been successfully logged in!']);
            }
            return redirect()->route('index')->with('custom_alert', ['type' => 'success', 'title' => 'Logged in!', 'message' => 'You have been successfully logged in!']);

        }

        // Authentication failed...
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('client')->logout();
        return redirect()->route('showLoginForm');
    }

    public function showForgotForm()
    {
        return view('auth.forgot');
    }

    public function sendResetLink(Request $request){
        $request->validate([
            'email' => ['required','email','exists:clients,email'],
        ]);

        DB::table('password_resets')->where([
            'email' => $request->email,
        ])->delete();
        
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        
        try {
            Mail::send('email.emailForgotPassword', ['token' => $token], function ($message) use ($request) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->sender(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->to($request->email);
                $message->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->subject('Email For The Password Reset');
                $message->priority(1);
                //$message->attach('pathToFile');
            });
            return back()->with('custom_alert', ['type' => 'success', 'title' => 'password reset link', 'message' => 'we have e-mailed your password reset link.']);
        } catch (\Exception $e) {
            if ($e->getMessage()) {
                return back()->with('custom_alert', ['type' => 'worning', 'title' => 'Something went wrong.', 'message' => 'Please try again later.']);
            }
        }
    }

    public function showResetForm($token)
    {
        return view('auth.resetPassword',compact('token'));
    }

    public function resePassword(Request $request)
    {
        $request->validate([
            'token'=>['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => 'required|min:8',
        ]);

        $email = DB::table('password_resets')
        ->where('token', $request->token)
        ->select('email')
        ->value('email');
        if(!$email){
            return back()->with('custom_alert', ['type' => 'worning', 'title' => 'Invalid Token', 'message' => 'Please try again later.']);
        }else{

            Client::where('email',$email)->update([
                'password'=> Hash::make($request->password),
            ]);

            DB::table('password_resets')->where([
                'email' => $email,
            ])->delete();

            return redirect()->route('showLoginForm')->with('custom_alert', ['type' => 'success', 'title' => 'Your Password has been changed!', 'message' => 'You can login with new password']);
        }
    }

}
