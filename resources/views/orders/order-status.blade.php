@push('styles')
    <style>
        .item-status {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
            text-align: center;
        }

        .item-status i {
            font-size: 15px;
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
    </style>
@endpush

@switch($order->status)

    @case('paid')
        <div class="item-status paid"> <i class="fas fa-check"></i></div>
        {{ $order->status }}
    @break

    @case('in process')
        <div class="item-status in_process"><i class="fa-solid fa-spinner"></i></div>
        {{ $order->status }}
    @break

    @case('failed')
        <div class="item-status failed"><i class="fa-solid fa-xmark"></i></div>
        {{ $order->status }}
    @break

    @case('refunded')
        <div class="item-status refunded"><i class="fas fa-redo-alt"></i></div>
        {{ $order->status }}
    @break

    @case('canceled')
        <div class="item-status canceled"><i class="fa-solid fa-xmark"></i></div>
        {{ $order->status }}
    @break

    @default
        <div class="item-status default"><i class="fas fa-circle-notch"></i></div>
        {{ $order->status }}
@endswitch