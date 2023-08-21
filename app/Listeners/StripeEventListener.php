<?php

namespace App\Listeners;

use App\Jobs\OrderCanceled;
use App\Jobs\OrderPaid;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\WebhookReceived;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class StripeEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle received Stripe webhooks.
     *
     * @param  \Laravel\Cashier\Events\WebhookReceived  $event
     * @return void
     */
    public function handle(WebhookReceived $event)
    {
        if ($event->payload['type'] === 'payment_intent.succeeded') {
     
            $metadata = $event->payload['data']['object']['charges']['data'][0]['metadata']['order_id'];
            try {
                $order = Order::findOrFail($metadata);
                $order->update(["status" => 'paid']);
            
                if ($order->meeting) {
                    $order->meeting->update(["status" => 'paid']);
                }

                dispatch(new OrderPaid($order));
            } catch (\Exception $e) {
                // Handle exceptions (e.g., order not found)
                Log::info($e->getMessage());
            }
            
        }

        if ($event->payload['type'] === 'payment_intent.payment_failed') {
            $metadata = $event->payload['data']['object']['charges']['data'][0]['metadata']['order_id'];
            try {
                $order = Order::findOrFail($metadata);
                $order->update(["status" => 'canceled']);
            
                if ($order->meeting) {
                    $order->meeting->update(["status" => 'canceled']);
                }

                dispatch(new OrderCanceled($order));
            } catch (\Exception $e) {
                // Handle exceptions (e.g., order not found)
                Log::info($e->getMessage());
            }
        }

    }
}
