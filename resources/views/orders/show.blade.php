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
            border-radius: 10px;
        }

        .status-paid {
            color: #89d200;
            border: 2px dashed #8bc34a;
        }

        .status-in_process {
            color: #007bff;
            border: 2px dashed #007bff;
        }

        .status-refunded {
            color: #e87436;
            border: 2px dashed #ffc107;
        }

        .status-canceled {
            color: #dc3545;
            border: 2px dashed #dc3545;
        }

        .status-failed {
            color: #dc3545;
            border: 2px dashed #dc3545;
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
<x-breadcrumb globalTitle="{{ __('meeting_order.Meeting_Details')}}" secondTitle="{{ __('meeting_order.Meeting_Details')}}" />
<div class="cart-container" >
    <div class="order-header mt-2 mb-3">
        <a href="{{route('orders')}}" class="custom-button">
            <i class="mr-1 fas fa-arrow-left"></i> {{ __('meeting_order.Back')}}
        </a>
        @if ($order->meeting->status=='paid')
            <a href="{{route('download-invoice',$order)}}" class="custom-button">
                <i class="fas fa-print"></i> {{ __('meeting_order.Print')}}
            </a>
        @endif
    </div>

    <div class="table-container" style="{{ app()->getLocale() == 'ar' ? "direction: rtl;" : "" }}">
        <table class="styled-table">
            <thead>
                <tr>
                    <th class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}">{{ __('meeting_order.Ref')}}</th>
                    <th class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}">{{ __('frontend.service')}}</th>
                    <th class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}">{{ __('meeting_order.Order_Date')}}</th>
                    <th class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}">{{ __('meeting_order.Paid_Amount')}}</th>
                    <th class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}">{{ __('meeting_order.Discount')}}</th>
                    <th class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}">{{ __('meeting_order.Price')}}</th>
                    <th class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}">{{ __('meeting_order.Tax')}}</th>
                    <th class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}">{{ __('meeting_order.Order_Status')}}</th>
                </tr>
            </thead>
            <tbody>
                <tr  class="order">
                    <td>{{ $order->ref ?? '' }}</td>
                    <td style="min-width: 150px">{{ $order->meeting->service?->translate(app()->getLocale() , 'fallbackLocale')->title ?? '' }}</td>
                    <td style="min-width: 150px" class="text-secondary">{{ $order->created_at->format('d-m-Y') ?? '' }}</td>
                    <td style="min-width: 20px" class="text-primary fw-bold"> ${{ number_format($order->paid_amount, 2) ?? '' }}</td>
                    <td style="min-width: 20px" class="text-success fw-bold"> -${{ number_format($order->discount, 2) ?? '' }}</td>
                    <td style="min-width: 20px" class="text-secondary fw-bold"> ${{ number_format($order->price, 2) ?? '' }}</td>
                    <td style="min-width: 20px" class="text-danger fw-bold"> +${{ number_format($order->tax, 2) ?? '' }}</td>
                    <td style="min-width: 50px"  class="text-center"> 
                        @include('orders.order-status', ['order' => $order])
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="clock-container mt-2">
        <div class="fw-bold text-secondary fs-3 mb-2">
            {{ __('meeting_order.Meeting_Details')}}
        </div>
        <div class="time fw-bold mb-2" id="timeDisplay">{{ \Carbon\Carbon::parse($order->meeting->DateMeeting)->format('h:i A') }}</div>
        <div class="date text-secondary mb-2" id="dateDisplay">{{ \Carbon\Carbon::parse($order->meeting->DateMeeting)->format('d/m/Y') }}</div>
        <div class="mt-2">
            @switch($order->meeting->status)
                @case('paid')
                    <div class="meeting-status status-paid">{{ __('meeting_order.Statuses.Paid') }}</div>
                @break
                @case('in process')
                    <div class="meeting-status status-in_process"> {{ __('meeting_order.Statuses.In_Process') }}</div>
                @break
                @case('failed')
                    <div class="meeting-status status-failed">{{ __('meeting_order.Statuses.Failed') }}</div>
                @break
                @case('refunded')
                    <div class="meeting-status status-refunded"> {{ __('meeting_order.Statuses.Refunded') }}</i></div>
                @break
                @case('canceled')
                    <div class="meeting-status status-canceled"> {{ __('meeting_order.Statuses.Canceled') }}</i></div>
                @break
                @default
                    <div class="meeting-status default">{{$order->meeting->status}}</div>
            @endswitch
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function clearCart(){
            document.cookie = "cart=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "serviceId=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            console.log('test');
        }
        clearCart()
    </script>
@endpush
@endsection