<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function index()
    {
        $daysWithHours = Day::with('hours')->get();
        $meetings = Meeting::where("status", "paid")
            ->where("DateMeeting", ">=", now()->toDateString())
            ->select("DateMeeting")
            ->get();
        $local = str_replace('_', '-', app()->getLocale());
     
        return view('welcome', ['daysWithHours' => $daysWithHours ,'meetings' =>$meetings,'local'=>$local]);
    }

    public function showDetails()  {
        $dateMeeting = json_decode(request()->cookie('cart'))[0] ?? null;
        $price=setting('site.price_meeting');
        $local = str_replace('_', '-', app()->getLocale());
        $discount = is_numeric(setting('site.discount_percentage')) ? setting('site.discount_percentage'): 0;
        return view('appointment-details', [
                'discount' => $discount,
                'price'=>$price,
                'dateMeeting'=>$dateMeeting,
                'local'=>$local
        ]);


    }

    public function payMeeting(Request $request)
    {
        $request->validate([
            'payment_method' => ['required', 'string', 'max:255'],
            'dateMeeting' => ['required', 'string', 'max:255'],
        ]);

        $client = Auth::guard('client')->user();
        $paymentMethod = $request->payment_method;

        $discountPercentage = is_numeric(setting('site.discount_percentage')) ? setting('site.discount_percentage'): 0;
        $price= is_numeric(setting('site.price_meeting')) ? setting('site.price_meeting'): 0;

        $total=$price * (1 - ($discountPercentage / 100));


        try {
            $client->createOrGetStripeCustomer();
            $client->updateDefaultPaymentMethod($paymentMethod);
            $client->charge($total * 100, $paymentMethod, [
                'metadata' => [
                    'client_id' => $client->id,
                ],
            ]);
            
        } catch (\Exception $exception) {
            return back()->with('custom_alert', ['type' => 'warning', 'title' => 'Sorry Error!', 'message' => 'there is an error! please try again .']);;
        }

        return redirect()->route('index')->with('custom_alert', ['type' => 'success', 'title' => 'Thank you for your order!', 'message' => 'the order has been successfully placed.']);
        // dd($request);
    }
}
