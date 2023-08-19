@extends('layouts.app')
@section('content')
@push('styles')
    <style>
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .clock-container {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
        }
        .time {
            font-size: 36px;
            color: #333333;
        }
        .date {
            font-size: 24px;
        }
        .meeting-status {
            display: inline-flex;
            align-items: center;
            font-size: 14px;
            padding: 5px 10px;
        }

        .status-paid {
            color: #8ec044;
            border: 2px dashed #8ec044;
            border-radius: 10px;
        }

        .status-inprogress {
            color: #007bff;
            border: 2px dashed #007bff;
            border-radius: 10px;
        }

        .status-canceled {
            color: #dc3545;
            border: 2px dashed  #dc3545;
            border-radius: 10px;
        }
        .table-container {
            overflow-x: auto;
            /* max-width: 80%; */
        }

        .styled-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 10px;
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
        .orders-container {
            max-width: 1260px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f2f5f7;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        .show-btn {
            color: #62016ab5;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .show-btn:hover {
            color: #b128ff;
        }
        /* Responsive styles */
        @media (max-width: 768px) {
            .table-container {
                max-width: 100%;
            }
        }
    </style>
@endpush

<div class="cart-container">
    <div class="order-header mt-2 mb-3">
        <a href="{{route('orders')}}" class="btn btn-md btn-outline-warning">
            <i class="mr-1 fa-solid fa-arrow-left"></i> Back
        </a>
        @if ($order->meeting->status=='paid')
            <a href="{{route('download-invoice',$order)}}" class="btn btn-md btn-outline-primary">
                <i class="fa-solid fa-print"></i> print
            </a>
        @endif
    </div>

    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>Order date</th>
                    <th>Paid amount</th>
                    <th>Discount</th>
                    <th>Price</th>
                    <th>Tax</th>
                    <th>Order status</th>
                </tr>
            </thead>
            <tbody>
                <tr  class="order">
                    <td>{{ $order->ref ?? '' }}</td>
                    <td class="text-secondary">{{ $order->created_at->format('d-m-Y') ?? '' }}</td>
                    <td class="text-primary fw-bold"> ${{ number_format($order->paid_amount, 2) ?? '' }}</td>
                    <td class="text-success fw-bold"> -${{ number_format($order->discount, 2) ?? '' }}</td>
                    <td class="text-secondary fw-bold"> ${{ number_format($order->price, 2) ?? '' }}</td>
                    <td class="text-danger fw-bold"> +${{ number_format($order->tax, 2) ?? '' }}</td>
                    <td  class="text-center"> 
                        @include('orders.order-status', ['order' => $order])
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="clock-container mt-2">
        <div class="fw-bold text-secondary fs-3">
            Meeting Details
        </div>
        <div class="time fw-bold" id="timeDisplay">{{ \Carbon\Carbon::parse($order->meeting->DateMeeting)->format('h:i A') }}</div>
        <div class="date text-secondary" id="dateDisplay">{{ \Carbon\Carbon::parse($order->meeting->DateMeeting)->format('d/m/Y') }}</div>
        <div class="mt-2">
            @switch($order->meeting->status)
                @case('paid')
                    <div class="meeting-status status-paid">{{$order->meeting->status}}</div>
                @break

                @case('canceled')
                    <div class="meeting-status status-canceled">{{$order->meeting->status}}</i></div>
                @break

                @default
                    <div class="meeting-status status-inprogress">{{$order->meeting->status}}</div>
            @endswitch
        </div>
    </div>
</div>


@endsection