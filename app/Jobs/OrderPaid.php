<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderPaid implements ShouldQueue
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
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = $this->order->client;
        $paidOrder = Order::with('meeting')->where('status', 'paid')
            ->findOrFail($this->order->id);
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
        $pdf = Pdf::loadView('pdf.invoice', compact('data'));
        $attachment = $pdf->output();
        try {
            Mail::send('email.emailOrderPaid', ['client' => $client,'order' => $this->order], function ($message) use ($client,$attachment,$paidOrder) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->sender(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->to($client->email);
                $message->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->subject('Your Order Paid');
                $message->priority(1);
                $message->attachData($attachment, 'invoice_'.$paidOrder->ref.'.pdf', ['mime' => 'application/pdf']);
            });
        } catch (\Exception $e) {
            // if ($e->getMessage()) {
                
            // }
        }
    }
}
