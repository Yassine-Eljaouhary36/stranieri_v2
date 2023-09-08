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
            'email' => ['required', 'email', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'max:20'],
        ]);

        $credentials = $request->only('email', 'password');

        // dd(Auth::guard('client')->attempt($credentials));
        if (Auth::guard('client')->attempt($credentials)) {
            // Authentication passed...
            if (!empty(json_decode(request()->cookie('cart'))[0]) ) {
                return redirect()->route('show-Details')->with('custom_alert', ['type' => 'success', 'title' => __('register_login.Title_Logged_In'), 'message' => __('register_login.Message_Successfully_Logged_In')]);
            }
            return redirect()->route('index')->with('custom_alert', ['type' => 'success', 'title' => __('register_login.Title_Logged_In'), 'message' => __('register_login.Message_Successfully_Logged_In')]);

        }

        // Authentication failed...
        return redirect()->back()->withErrors([
            'email' => trans('auth.failed'),
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
            'email' => ['required','email','min:6', 'max:100','string','exists:clients,email'],
        ]);
      
        if (
            Client::where('email', $request->email)->first()->is_email_verified == 0
            ||
            Client::where('email', $request->email)->first()->status != 'active'
        ) {
            return back()->with('custom_alert', ['type' => 'worning', 'title' => __('register_login.Something_Went_Wrong'), 'message' => __('register_login.Please_Try_Again_Later')]);
        }

        $passReset = DB::table('password_resets')->where([
            'email' => $request->email,
        ])->first();

        if ($passReset && Carbon::parse($passReset->created_at)->addMinutes(15)->isPast()) {
            DB::table('password_resets')->where([
                'email' => $request->email,
            ])->delete();
        } else if ($passReset) {
            return back()->with('custom_alert', ['type' => 'worning', 'title' => __('register_login.Something_Went_Wrong'), 'message' => __('register_login.Message_Already_Mailed_Password_Reset_Link')]);
        }
        
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
            return back()->with('custom_alert', ['type' => 'success', 'title' => __('register_login.Title_Mailed_Password_Reset_Link'), 'message' => __('register_login.Message_Mailed_Password_Reset_Link')]);
        } catch (\Exception $e) {
            if ($e->getMessage()) {
                return back()->with('custom_alert', ['type' => 'worning', 'title' => __('register_login.Something_Went_Wrong'), 'message' => __('register_login.Please_Try_Again_Later')]);
            }
        }
    }

    public function showResetForm($token)
    {
        $validToken = DB::table('password_resets')
            ->where('token', $token)
            ->first();
        if (!$validToken || Carbon::parse($validToken->created_at)->addMinutes(15)->isPast()) {
            return back()->with('custom_alert', ['type' => 'worning', 'title' => __('register_login.Title_Invalid_Token'), 'message' => __('register_login.Please_Try_Again_Later')]);
        }
        return view('auth.resetPassword',compact('token'));
    }

    public function resePassword(Request $request)
    {
        $request->validate([
            'token' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed'],
        ]);

        $email = DB::table('password_resets')
        ->where('token', $request->token)
        ->select('email')
        ->value('email');
        if(!$email){
            return back()->with('custom_alert', ['type' => 'worning', 'title' => __('register_login.Title_Invalid_Token'), 'message' => __('register_login.Please_Try_Again_Later')]);
        }else{

            Client::where('email',$email)->update([
                'password'=> Hash::make($request->password),
            ]);

            DB::table('password_resets')->where([
                'email' => $email,
            ])->delete();

            return redirect()->route('showLoginForm')->with('custom_alert', ['type' => 'success', 'title' => __('register_login.Title_Password_Changed'), 'message' => __('register_login.Message_Password_Changed')]);
        }
    }

}
