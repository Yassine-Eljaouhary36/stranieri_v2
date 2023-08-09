<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Meeting;
use Illuminate\Http\Request;

class DayController extends Controller
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
}
