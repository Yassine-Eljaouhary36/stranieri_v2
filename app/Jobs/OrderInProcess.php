<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderInProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order=$order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client=$this->order->client;
        try {
            Mail::send('email.emailOrderInProcess', ['client' => $client,'order' => $this->order], function ($message) use ($client) {
                $message->from('contact@elitechit.com', env('MAIL_FROM_NAME'));
                $message->sender('contact@elitechit.com', env('MAIL_FROM_NAME'));
                $message->to($client->email);
                $message->replyTo('contact@elitechit.com', env('MAIL_FROM_NAME'));
                $message->subject('Your Order In Process');
                $message->priority(1);
            });
        } catch (\Exception $e) {
            // if ($e->getMessage()) {
                
            // }
        }
    }
}
