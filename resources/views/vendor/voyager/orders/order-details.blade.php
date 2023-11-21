@extends('voyager::master')

@section('content')
    <div class="page-content ">
        <h2>Order Details</h2>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h3>Order Information</h3>
                <p>Order ID: <span class="order-infos">{{ $order->id }}</span> 
                    <a href="{{ route('voyager.orders.edit', $order->id) }}" class="btn btn-success">Edit</a>
                </p>
                <p>Order Ref: <span class="order-infos">{{ $order->ref }}</span></p>
                <p>Order Date: <span class="order-infos">{{ $order->created_at->format('Y-M-d h:i A') }}</span></p>
                <p>Status: <span class="order-infos">{{ $order->status }}</span></p>
                <p>Tax: <span class="order-infos">${{ $order->tax }}</span></p>
                <p>Discount: <span class="order-infos">${{ $order->discount }}</span></p>
                <p>Total: <span class="order-infos">${{ $order->paid_amount }}</span></p>
            </div>
            <div class="col-md-6">
                <h3>Client Information</h3>
                <p>Name: <span class="order-infos">{{ $order->client?->first_name . ' ' . $order->client->last_name }}</span></p>
                <p>Email: <span class="order-infos">{{ $order->client?->email }}</span></p>
                <p>Phone: <span class="order-infos">{{ $order->client?->phone }}</span></p>
            </div>
        </div>
        <hr>
        <h3>Meeting information</h3>
        <div class="table-container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Ref</th>
                        <th>Meeting Date</th>
                        <th>Service</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->meeting->ref }}</td>
                        <td style="min-width: 192px">
                            {{ \Carbon\Carbon::parse($order->meeting->DateMeeting)->format('h:i A d-m-Y') ?? '' }}
                        </td>
                        <td style="min-width: 200px">{{ $order->meeting->service->title ?? '' }}</td>
                        <td style="min-width: 50">{{ $order->meeting->service?->duration .'min'?? '' }}</td>
                        <td style="min-width: 186px">{{ $order->meeting->status }}</td>
                        <td>
                            <a href="{{route('voyager.meetings.edit', $order->meeting->id)}}"
                                class="btn btn-success">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop

<style>
    .page-content {
        padding: 20px 50px;
    }

    p {
        color: #666;
        font-size: 16px;
        font-weight: 600;
    }
    a {
        text-decoration: none !important;
    }
    .btn.btn-success {
        padding: 2px 10px !important;
    }
   .btn.btn-info {
        padding: 1px 10px !important;
    }
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .styled-table th, .styled-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    .styled-table th {
        background-color: #f0f0f0;
        font-weight: bold;
    }

    .styled-table tbody tr:hover {
        background-color: #e0e0e0;
    }

    .table-container {
        overflow-x: auto;
    }
   .order-infos{
        color:#9a9a9a;
        font-weight: 400;
   }
</style>