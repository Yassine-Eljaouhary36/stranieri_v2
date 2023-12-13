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
            padding: 20px;
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
        .invoice-logo {
            /* width: 150px; */
            text-align: center;
        }
        .invoice-items {
            margin-top: 20px;
        }
        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .item-name {
            flex: 2;
        }
        .item-price {
            flex: 1;
            text-align: right;
        }
        .total {
            margin-top: 20px;
            text-align: right;
        }
        .additional-info {
            margin-top: 20px;
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
        .footer{
            padding: 20px;
            background-color: #a276f4;
            color: white;
            font-weight: 600;
            font-family: sans-serif;
            text-align: center;
            margin-top: 50px
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <div class="invoice-logo">
                @if (setting('site.logo') != null)
                    <img src="{{asset('storage/'.str_replace('\\', '/',setting('site.logo')))}}" alt="Logo" width="200">
                @endif 
            </div>
            <h1>Invoice</h1>
        </div>
        <div class="invoice-details">
            <div class="invoice-info">
                <p>From: {{setting('site.title')}}</p>
                <p>To: {{$data['client']['first_name']}} {{$data['client']['last_name']}}</p>
            </div>

        </div>

        <table class="order-infos-table mt-3"  >
            <tbody>
                <tr>
                    <td class="text-center">{{ __('Order reference')}} </td>
                    <td class="text-center"><span class="text-secondary">{{ $data['ref'] }}</span></td>
                </tr>
                <tr>
                    <td class="text-center">{{ __('Service')}} </td>
                    <td class="text-center"><span class="text-secondary">{{ $data['service']['title']}}</span></td>
                </tr>
                <tr>
                    <td class="text-center">{{ __('duration')}} </td>
                    <td class="text-center"><span class="text-secondary">{{ $data['service']['duration'] . 'min'}}</span></td>
                </tr>
                <tr>
                    <td class="text-center">{{ __('Date meeting')}} </td>
                    <td class="text-center"><span class="text-secondary">{{ \Carbon\Carbon::parse($data['meeting']['DateMeeting'])->format('H:i d/m/Y') }}</span></td>
                </tr>
                <tr>
                    <td class="text-center">{{ __('Paid amount')}} </td>
                    <td class="text-center"><span class="text-primary">${{ number_format($data['paid_amount'], 2) ?? '' }}</span></td>
                </tr>
                <tr>
                    <td class="text-center">{{ __('Order Date')}} </td>
                    <td class="text-center"><span class="text-danger">{{ \Carbon\Carbon::parse($data['created_at'])->format('H:i d-m-Y') ?? '' }}</span></td>
                </tr>
            </tbody>
        </table>
        <div class="client-info">
            <p>Email: {{$data['client']['email']}} </p>
            <p>Billing Address: {{$data['client']['address_one']}} ,{{$data['client']['address_two']}} , {{$data['client']['city']}} , {{$data['client']['country']}} </p>
        </div>
        <div class="footer">
            <span style="padding: 0px 5px">{{ App()->communication->email }}</span>
            <span style="padding: 0px 5px">{{ App()->communication->phone }}</span>
        </div> 
    </div>
</body>
</html>
