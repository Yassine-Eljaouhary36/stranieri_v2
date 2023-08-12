<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index()
    {
        $daysWithHours = Day::with('hours')->get();
        $meetings = Meeting::where("status", "paid")
            ->where("DateMeeting", ">=", now()->toDateString())
            ->select("DateMeeting")
            ->get();
        // dd($meetings);

        return view('welcome', ['daysWithHours' => $daysWithHours ,'meetings' =>$meetings]);
    }

    public function showDetails()  {
        $dateMeeting = json_decode(request()->cookie('cart'))[0] ?? null;
        $price=setting('site.price_meeting');
  
        $discount = is_numeric(setting('site.discount_percentage')) ? setting('site.discount_percentage'): 0;
        return view('appointment-details', [
                'discount' => $discount,
                'price'=>$price,
                'dateMeeting'=>$dateMeeting
        ]);


    }

    public function payMeeting(Request $request)
    {
        // return redirect()->route('index')->with('custom_alert', ['type' => 'warning', 'title' => 'Sorry!', 'message' => 'messge.']);
        dd($request);
    }
}
