<?php

namespace App\Http\Controllers;

use App\Jobs\OrderInProcess;
use App\Models\Day;
use App\Models\Meeting;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function index()
    {
        $daysWithHours = Day::with('hours')->get();
        $meetings = Meeting::where(function ($query) {
                    $query->where('status', 'paid')
                        ->orWhere('status', 'in process');
                })
            ->where("DateMeeting", ">=", now()->toDateString())
            ->select("DateMeeting")
            ->get();
        $local = str_replace('_', '-', app()->getLocale());
     
        return view('welcome', ['daysWithHours' => $daysWithHours ,'meetings' =>$meetings,'local'=>$local]);
    }

    public function showDetails()  {
        $orderTotal = 0;
        $taxRate = is_numeric(setting('site.tax_rate')) ? setting('site.tax_rate'): 0;
        $estimatedTax = 0;

        $dateMeeting = json_decode(request()->cookie('cart'))[0] ?? null;

        $client = Auth::guard('client')->user();
        $originalPrice=is_numeric(setting('site.price_meeting')) ? setting('site.price_meeting'): 0;
        $discountPercentage = is_numeric(setting('site.discount_percentage')) ? setting('site.discount_percentage'): 0;

        $discountedPrice = $originalPrice - ($originalPrice * ($discountPercentage / 100));
        $amountSaved = $originalPrice - $discountedPrice;

        
        $orderTotal = $discountedPrice + ($taxRate * $originalPrice);
        $estimatedTax = $taxRate * $originalPrice;
        
        return view('appointment-details', [
            'dateMeeting'=>$dateMeeting,
            'price'=>$originalPrice,
            'local'=>str_replace('_', '-', app()->getLocale()),
            'client'=>$client,
            'data' => [
                    'totalBeforeTax'    => number_format($originalPrice, 2, ',', ' '),
                    'totalDiscount'     => number_format($amountSaved, 2, ',', ' '),
                    'estimatedTax'      => number_format($estimatedTax, 2, ',', ' '), // 20% tax
                    'taxRate'           => $taxRate * 100,
                    'orderTotal'        => number_format($orderTotal, 2, ',', ' '),
            ],
        ]);


    }

    public function payMeeting(Request $request)
    {
        $request->validate([
            'payment_method' => ['required', 'string', 'max:255'],
            'dateMeeting' => ['required', 'string', 'max:255'],
        ]);

        $meetings = Meeting::where(function ($query) {
            $query->where('status', 'paid')
                  ->orWhere('status', 'in process');
        })
        ->where('DateMeeting', '>=', now()->toDateString())
        ->where('DateMeeting', '=', $request->dateMeeting) 
        ->select('DateMeeting')
        ->get();
 
        if(count($meetings) === 0){
            $client = Auth::guard('client')->user();
            $paymentMethod = $request->payment_method;

            $taxRate = is_numeric(setting('site.tax_rate')) ? setting('site.tax_rate'): 0;
            $originalPrice=is_numeric(setting('site.price_meeting')) ? setting('site.price_meeting'): 0;
            $discountPercentage = is_numeric(setting('site.discount_percentage')) ? setting('site.discount_percentage'): 0;
            $discountedPrice = $originalPrice - ($originalPrice * ($discountPercentage / 100));
            $amountSaved = $originalPrice - $discountedPrice;

            
            $orderTotal = $discountedPrice + ($taxRate * $originalPrice);
            $estimatedTax = $taxRate * $originalPrice;

            $order = Order::create([
                'paid_amount' => $orderTotal,
                'discount'=>$amountSaved,
                'price'=>$originalPrice,
                'tax' =>$estimatedTax, 
                'status' => 'in process',
                'client_id'=>$client->id
            ]);
   
            $meeting = Meeting::create([
                'DateMeeting' => $request->dateMeeting, 
                'status' => 'in process', 
                'order_id'=> $order->id,
                'client_id' => $client->id
            ]);
            try {
                $client->createOrGetStripeCustomer();
                $client->updateDefaultPaymentMethod($paymentMethod);
                $client->charge($orderTotal * 100, $paymentMethod, [
                    'metadata' => [
                        'order_id'=> $order->id,
                    ],
                ]);
                
            } catch (\Exception $exception) {
                return back()->with('custom_alert', ['type' => 'warning', 'title' => 'Sorry Error!', 'message' => 'there is an error! please try again .']);
            }


            dispatch(new OrderInProcess($order));
            return redirect()->route('order',$order)->with('custom_alert', ['type' => 'success', 'title' => 'Thank you for your order!', 'message' => 'the order has been successfully placed.']);
        }
        return back()->with('custom_alert', ['type' => 'warning', 'title' => ' The meeting has been taken!', 'message' => 'Sorry , the meeting was taken by another client! please choose other one again .']);;
    }
}
