<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

}
