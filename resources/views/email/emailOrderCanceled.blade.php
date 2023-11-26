<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice {
            max-width: 800px;
            margin: 0 auto;
            padding: 25px;
            background-color: #f7f7f7;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .invoice-info {
            flex: 1;
        }
        .order-info {
            margin: 25px auto;
            max-width: 450px;
        }
        .invoice-logo {
            /* width: 150px; */
            text-align: center;
        }
        .client-info {
            margin-top: 20px;
        }
        .order-infos-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
            border-radius: 5px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .order-infos-table th, .order-infos-table td {
            padding: 5px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .order-infos-table tr td:first-child {
            background-color: #e2f4ff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <div class="invoice-logo">
                {{-- <img src="https://assets.stickpng.com/images/5954bb45deaf2c03413be353.png" alt="Logo" width="100"> --}}
                @if (setting('site.logo') != null)
                    <img src="{{asset('storage/'.str_replace('\\', '/',setting('site.logo')))}}" alt="Logo" width="200">
                @endif
            </div>
        </div>
        <div class="invoice-details">
            <p style="margin: 0px 10px">Dear {{$client->first_name}} {{$client->last_name}} ,</p>
        </div>
        <div style="margin: 0px 10px 5px 10px">
            <p>
                We regret to inform you that your order has been cancelled due to a payment failure.
            </p>
        </div>
        
        <div class="order-info">
            <table class="order-infos-table mt-3"  >
                <tbody>
                    <tr>
                        <td class="text-center">{{ __('Order reference')}} </td>
                        <td class="text-center"><span class="text-secondary">{{ $order->ref }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-center">{{ __('service')}} </td>
                        <td class="text-center"><span class="text-secondary">{{ $order->meeting->service->title }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-center">{{ __('duration')}} </td>
                        <td class="text-center"><span class="text-secondary">{{ $order->meeting->service->duration . 'min' }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-center">{{ __('Date meeting')}} </td>
                        <td class="text-center"><span class="text-secondary">{{ \Carbon\Carbon::parse($order->meeting->DateMeeting)->format('H:i d/m/Y') }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-center">{{ __('Paid amount')}} </td>
                        <td class="text-center"><span class="text-primary">${{ number_format($order->paid_amount, 2) ?? '' }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-center">{{ __('Tax')}} </td>
                        <td class="text-center"><span class="text-danger">${{ number_format($order->tax, 2) ?? '' }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-center">{{ __('Order Date')}} </td>
                        <td class="text-center"><span class="text-danger">{{ \Carbon\Carbon::parse($order->created_at)->format('H:i d-m-Y') ?? '' }}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    
        <div style="margin: 10px;color:#848383">
            <p>
                Please note: we would like to remind you of our refund policy, which states that you can only request for a refund if you cancel your meeting at least 72 hours before the scheduled start time.
            </p>
            <p>
                If you have any questions or concerns, please contact us at {{env('MAIL_FROM_ADDRESS')}}.
            </p>
        </div>
    </div>
</body>
</html>
