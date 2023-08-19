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
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <div class="invoice-logo">
                {{-- <img src="https://assets.stickpng.com/images/5954bb45deaf2c03413be353.png" alt="Logo" width="100"> --}}
                @if (file_exists('storage/' . setting('site.logo')) && setting('site.logo') != null)
                    <img src="{{asset('storage/'.(setting('site.logo')))}}" alt="Logo" width="100">
                @endif
            </div>
            <h1>Invoice</h1>
        </div>
        <div class="invoice-details">
            <div class="invoice-info">
                <p>Dear {{$client->first_name}} {{$client->last_name}} ,</p>
            </div>
        </div>
        <div style="margin: 0px 0px 5px 0px">
            <p>
                We hope this email finds you well. We wanted to inform you that your recent order with us is currently in process.
            </p>
        </div>
        
        <div class="invoice-info">
            <p style="font-size: 18px; color: #949494; font-weight: 600"><span>Order reference:</span>{{$order->ref}}</p>
        </div>
        
        <div class="invoice-items">
            <div class="item-row">
                <div class="item-name">Book a meeting</div>
                <div class="item-name" style=" font-weight: 600; color: #949494">
                   <span style="margin-right: 5px ; color: #1694ef">{{ \Carbon\Carbon::parse($order->meeting->DateMeeting)->format('H:i') }} </span>
                    <span style="margin-right: 5px ; color: #949494">{{ \Carbon\Carbon::parse($order->meeting->DateMeeting)->format('d/m/Y') }}</span>
                </div>
                <div class="item-price">${{ number_format($order->price, 2) ?? '' }}</div>
            </div>
        </div>
        <div class="total">
            <p>Discount: ${{ number_format($order->discount, 2) ?? '' }}</p>
            <p>Tax: ${{ number_format($order->tax, 2) ?? '' }}</p>
            <p>Total: ${{ number_format($order->paid_amount, 2) ?? '' }}</p>
        </div>
        <div style="margin: 5px 0px">
            <p>
                We understand how important your order is to you, and we assure you that we are dedicated to providing you with the best service. 
                If you have any questions or need further assistance regarding your order, 
                please don't hesitate to reach out to our customer support team 
            </p>
            <p>
                Thank you for choosing us for your Service needs. We truly appreciate your business and look forward to serving you.
            </p>
        </div>
        <div class="additional-info">
            <p>Order Date: {{ \Carbon\Carbon::parse($order->created_at)->format('H:i d-m-Y') ?? '' }}</p>
        </div>
        <div class="client-info">
            <p>Email: {{$client->email}} </p>
            <p>Billing Address: {{$client->billingAddress->address_one}} ,{{$client->billingAddress->address_two}} , {{$client->billingAddress->city}} , {{$client->billingAddress->country}} </p>
        </div> 
    </div>
</body>
</html>
