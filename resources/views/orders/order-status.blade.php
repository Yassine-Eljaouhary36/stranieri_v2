@push('styles')
<style>
    .item-status {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0px auto;
    }

    .item-status i {
        font-size: 16px;
    }

    .paid {
        color: #89d200;
        border: 1px solid #8bc34a;
    }

    .inprogress {
        color: #007bff;
        border: 1px solid #007bff;
    }

    .canceled {
        color: #dc3545;
        border: 1px solid #dc3545;
    }

</style>
@endpush

@switch($order->status)
    @case('paid')
        <div class="item-status paid"> <i class="fas fa-check"></i></div>
    @break

    @case('canceled')
        <div class="item-status canceled"><i class="fa-solid fa-xmark"></i></div>
    @break

    @default
        <div class="item-status inprogress"><i class="fa-solid fa-spinner"></i></div>
@endswitch