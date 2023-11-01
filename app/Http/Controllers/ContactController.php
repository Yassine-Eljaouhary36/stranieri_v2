<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index() {
        return view('contact-us');
    }

    public function contact(StoreContactRequest $request){
        
        $validated = $request->validated();
        $dataMail = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "subject" => $request->subject,
            "comment" => $request->comment
        ];
 
        $contact = Contact::create($validated);
        $message = __('register_login.Something_Went_Wrong');
        
        if ($contact) {
            try {
                Mail::send('email.contact', ['dataMail' => $dataMail], function ($message) use ($request) {
                    $message->from($request->email, $request->name);
                    $message->sender(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $message->to(env('MAIL_FROM_ADDRESS'));
                    $message->replyTo($request->email, $request->name);
                    $message->subject($request->subject);
                    $message->priority(1);
                    //$message->attach('pathToFile');
                });
            } catch (\Exception $e) {
                if ($e->getMessage()) {
                    return response()->json(['message' => $message]);
                }
            }
        } else {
            return response()->json(['message' => $message]);
        }
        $message = __('contact.sucess_message');
        return response()->json(['message' => $message]);
      
    }
}
