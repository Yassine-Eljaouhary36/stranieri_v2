<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function orders()
    {
        $client = Auth::guard('client')->user();

        $authenticatedClientWithOrders = Client::with('orders')->find($client->id);

        $orders = $authenticatedClientWithOrders->orders()->paginate(10);
        $orderStatuses = ['Paid','In process','Canceled'];
        return view('orders.index', compact('orders','orderStatuses'));
    }

    public function order(Order $order)
    {
        $client = Auth::guard('client')->user();
        $order = Order::with('meeting')->where('client_id', $client->id)
            ->findOrFail($order->id);
        
        return view('orders.show', compact('order'));
    }

    public function downloadInvoiceOrder(Order $order)
    {
        $paidOrder = $order = Order::with('meeting')->where('status', 'paid')
            ->findOrFail($order->id);
        $data=[
            'client'=>[
                'first_name'=>$paidOrder->client->first_name,
                'last_name'=>$paidOrder->client->last_name,
                'email'=>$paidOrder->client->email,
                'address_one'=>$paidOrder->client->billingAddress->address_one,
                'address_two'=>$paidOrder->client->billingAddress->address_two,
                'city'=>$paidOrder->client->billingAddress->city,
                'country'=>$paidOrder->client->billingAddress->country
            ],
            'meeting'=>[
                'DateMeeting'=>$paidOrder->meeting->DateMeeting,
            ],
            'service'=>[
                'title'=>$paidOrder->meeting->service->title,
                'duration'=>$paidOrder->meeting->service->duration,
            ],
            'discount'=>$paidOrder->discount,
            'paid_amount'=>$paidOrder->paid_amount,
            'tax'=>$paidOrder->tax,
            'created_at'=>$paidOrder->created_at,
            'ref'=>$paidOrder->ref,
            'price'=>$paidOrder->price,
        ];
      
        $pdf = Pdf::loadView('pdf.invoice', compact('data') );
        return $pdf->download('invoice.pdf');
    }

}
