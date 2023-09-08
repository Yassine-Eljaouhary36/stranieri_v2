@extends('layouts.app')
@section('content')
    @push('styles')
        <style>
        .table-container {
            overflow-x: auto;
            /* max-width: 80%; */
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
            background-color: transparent;
        }

        .show-btn:hover {
            color: #b128ff;
        }
        .paid-amount{
            display: inline-flex;
            align-items: center;
            padding: 2px 5px;
            color: #007bff;
            border: 1px dashed #007bff;
            border-radius: 10px;
        }
        /* Responsive styles */
        @media (max-width: 768px) {
            .table-container {
                max-width: 100%;
            }
        }
        </style>
    @endpush
    <div class="orders-container" style="{{ app()->getLocale() == 'ar' ? "direction: rtl;" : "" }}">
        <div class="text-center pt-2 pb-4 d-flex justify-content-between">
            <div class="pt-2"> <b>{{__('meeting_order.You_Have')}} </b>
                <span class="text-secondary">
                    {{ $orders->count() }} {{__('meeting_order.Orders')}}
                </span>
            </div>
            <div>
                <div class="btn-group dropstart">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i> {{__('meeting_order.Status')}}
                    </button>
                    <ul class="dropdown-menu">
                        <li><button class="statusFilter dropdown-item" type="button" data-status="" >All</button></li>
                        @foreach($orderStatuses as $status)
                            <li><button class="statusFilter dropdown-item" type="button" data-status="{{ $status }}">{{ $status }}</button></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
        </div>

        <div class="table-container">
            <table class="styled-table"  id="data-table">
                <thead>
                    <tr>
                        <th class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}" > {{__('meeting_order.Ref')}}</th>
                        <th class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}" > {{__('meeting_order.Meeting_At')}}</th>
                        <th class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}" > {{__('meeting_order.Paid_At')}}</th>
                        <th class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}" > {{__('meeting_order.Status')}}</th>
                        <th class="text-center">{{__('meeting_order.Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $key => $order)
                        <tr  class="order" data-status="{{ $order->status }}">
                            <td class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}">{{ $order->ref ?? '' }}</td>
                            <td style="min-width: 186px" class="text-secondary {{ app()->getLocale() == 'ar' ? "text-end" : "" }}">{{ \Carbon\Carbon::parse($order->meeting->DateMeeting)->format('h:i A d-m-Y') ?? '' }}</td>
                            <td style="min-width: 186px" class="text-secondary {{ app()->getLocale() == 'ar' ? "text-end" : "" }}">{{ $order->created_at->format('h:i A d-m-Y') ?? '' }}</td>
                            <td style="min-width: 186px" class="{{ app()->getLocale() == 'ar' ? "text-end" : "" }}"> 
                                @include('orders.order-status', ['order' => $order])
                            </td>
                            <td class="text-center" >
                                <x-showclockmeeting :ref="$order->ref" :meeting="$order->meeting" :id="$key"></x-showclockmeeting>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">No
                                Orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- @if (count($orders) >= 10) --}}
            <div class="d-flex border-top">
                <div class="px-5 m-auto py-3">
                    {{ $orders->links() }}
                </div>
            </div>
        {{-- @endif --}}
    </div>

    @push('scripts')
    <script>
        const orders = document.querySelectorAll('.order');
    
        // Select all the buttons with the class statusFilter
        var buttons = document.querySelectorAll(".statusFilter");

        // Loop through the buttons and add a click event listener to each one
        for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function() { 
            const selectedStatus = this.dataset.status;
            orders.forEach(order => {
                if (selectedStatus === '' || order.dataset.status.toLowerCase() === selectedStatus.toLowerCase()) {
                    order.style.display = 'table-row'; 
                } else {
                    order.style.display = 'none';
                }
            });
        });
        }
    </script>
        
    @endpush
@endsection