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
    <div class="orders-container">
        <div class="text-center pt-2 pb-4 d-flex justify-content-between">
            <div class="pt-2"> <b>You have: </b>
                <span class="text-secondary">
                    {{ $orders->count() }} Orders
                </span>
            </div>
            <div>
                <div class="btn-group dropstart">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i> status
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
                        <th >Ref</th>
                        <th >Meeting at</th>
                        <th >Paid at</th>
                        <th >Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $key => $order)
                        <tr  class="order" data-status="{{ $order->status }}">
                            <td>{{ $order->ref ?? '' }}</td>
                            <td style="min-width: 186px" class="text-secondary">{{ \Carbon\Carbon::parse($order->meeting->DateMeeting)->format('h:i A d-m-Y') ?? '' }}</td>
                            <td style="min-width: 186px" class="text-secondary">{{ $order->created_at->format('h:i A d-m-Y') ?? '' }}</td>
                            <td style="min-width: 186px"> 
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

        @if (count($orders) >= 10)
            <div class="d-flex border-top">
                <div class="px-5 m-auto py-3">
                    {{ $orders->links() }}
                </div>
            </div>
        @endif
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