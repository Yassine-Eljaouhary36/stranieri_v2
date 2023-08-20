<?php

namespace App\Listeners;

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
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(WebhookReceived $event)
    {
        if ($event->payload['type'] === 'invoice.payment_succeeded') {
     
            $payload = $event->payload;

            // Convert the payload to JSON format
            $payloadJson = json_encode($payload);
    
            // Store the payload in a text file
            Storage::disk('local')->put('file.txt', $payloadJson);
    
            Log::info('Stripe Event Received and Payload Saved to file.txt');
        }
    }
}
