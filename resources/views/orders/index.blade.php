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
                <select id="statusFilter" class="form-control">
                    <option value="">All</option>
                    @foreach($orderStatuses as $status)
                        <option value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            
        </div>

        <div class="table-container">
            <table class="styled-table"  id="data-table">
                <thead>
                    <tr>
                        <th>Ref</th>
                        <th>Order date</th>
                        <th>Paid amount</th>
                        <th>Discount</th>
                        <th>Price</th>
                        <th>Tax</th>
                        <th>Order status</th>
                        <th>date meeting</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $key => $order)
                        <tr  class="order" data-status="{{ $order->status }}">
                            <td>{{ $order->ref ?? '' }}</td>
                            <td class="text-center text-secondary">{{ $order->created_at->format('d-m-Y') ?? '' }}</td>
                            <td class="text-center text-primary fw-bold "> 
                                <span class="paid-amount">${{ number_format($order->paid_amount, 2) ?? '' }}</span>
                            </td>
                            <td class="text-center text-success fw-bold"> -${{ number_format($order->discount, 2) ?? '' }}</td>
                            <td class="text-center text-secondary fw-bold"> ${{ number_format($order->price, 2) ?? '' }}</td>
                            <td class="text-center text-danger fw-bold"> +${{ number_format($order->tax, 2) ?? '' }}</td>
                            <td  class="text-center"> 
                                @include('orders.order-status', ['order' => $order])
                            </td>
                            <td  class="text-center">
                                <x-showclockmeeting :ref="$order->ref" :meeting="$order->meeting" :id="$key"></x-showclockmeeting>
                            </td>
                            <td class="text-center" >
                                <a href="{{ route('order', $order->id) }}" class="show-btn">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
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
        const statusFilter = document.getElementById('statusFilter');
        const orders = document.querySelectorAll('.order');
    
        statusFilter.addEventListener('change', () => {
            const selectedStatus = statusFilter.value.toLowerCase();
    
            orders.forEach(order => {
                if (selectedStatus === '' || order.dataset.status === selectedStatus.toLowerCase()) {
                    order.style.display = 'table-row'; 
                } else {
                    order.style.display = 'none';
                }
            });
        });
    </script>
        
    @endpush
@endsection