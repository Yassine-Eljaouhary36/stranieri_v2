@extends('voyager::master')
@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        <div class="py-5">
            <div>
                <div>
                    <h3>Orders</h3>
                </div>
                <div class="filterBy">
                    <a href="{{ url()->current() . '?filterBy=all' }}">All</a>
                    <a href="{{ url()->current() . '?filterBy=today' }}">Today</a>
                    <a href="{{ url()->current() . '?filterBy=yesterday' }}">Yesterday</a>
                    <a href="{{ url()->current() . '?filterBy=thisWeek' }}">This week</a>
                    <a href="{{ url()->current() . '?filterBy=thisMonth' }}">this month</a>
                    <a href="{{ url()->current() . '?filterBy=pastMonth' }}">Past month</a>
                    <a href="{{ url()->current() . '?filterBy=thisYear' }}">This Year</a>
                    <a href="{{ url()->current() . '?filterBy=pastYear' }}">Past Year</a>
                </div>

                <div class="filterBy">
                    @foreach ($statuses as $status)
                        <a href="{{ url()->current() . '?filterBy=' . $status }}">{{ $status }}</a>
                    @endforeach
                </div>
        
            </div>
        
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Meeting Date</th>
                        <th scope="col">Service</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>{{ \Carbon\Carbon::parse($order->meeting->DateMeeting)->format('h:i A d-m-Y') ?? '' }}</td>
                            <th scope="row">{{ $order->meeting->service->title ?? '' }}</th>
                            <th scope="row">{{ $order->meeting->service?->duration .'min'?? '' }}</th>
                            <td>
                                @include('orders.order-status', ['status' => $order->status])
                            </td>
                            <td>${{ $order->paid_amount }}</td>
                            <td>{{ $order->created_at->format('Y-M-d h:i A') }}</td>
                            <td>
                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-info">Show</a>
                                <a href="{{ route('voyager.orders.edit', $order->id) }}" class="btn btn-success">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align: center">
                {{ $orders->links() }}
            </div>
        </div>
        
        <style>
            a {
                text-decoration: none !important;
            }
        
            .filterBy {
                border-bottom: 1px solid #ccc;
                padding: 15px 0;
            }
        
            .filterBy a {
                padding: 5px 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                margin-right: 5px;
                background: #fff;
                color: #000;
            }
        
            td {
                vertical-align: middle !important;
                padding: 3px 10px !important;
            }
        
            th {
                padding: 3px 10px;
            }
        
            .btn.btn-success {
                padding: 2px 10px !important;
            }
           .btn.btn-info {
                padding: 1px 10px !important;
            }
        
            .item-status {
                width: 25px;
                height: 25px;
                border-radius: 50%;
                display: inline-block;
                margin-right: 5px;
                text-align: center;
            }

            .item-status i {
                font-size: 11px;
            }

            .paid {
                color: #89d200;
                border: 1px solid #8bc34a;
            }
            
            .in_process {
                color: #007bff;
                border: 1px solid #007bff;
            }

            .refunded {
                color: #e87436;
                border: 1px solid #ffc107;
            }

            .canceled {
                color: #dc3545;
                border: 1px solid #dc3545;
            }

            .failed {
                color: #dc3545;
                border: 1px solid #dc3545;
            } 
            .page-content {
                padding: 20px 50px;
            }
        </style>
    </div>
@stop