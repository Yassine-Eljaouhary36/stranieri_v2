@push('styles')
    <style>

    .clock-container {
        text-align: center;
        padding: 20px;
        background-color: #edf7fe;
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
        padding: 2px 10px;
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

    .order-infos-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: #ffffff;
    }

    .order-infos-table th, .order-infos-table td {
        padding: 5px 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    .order-infos-table tr td:first-child {
        background-color: #f0f0f0;
        font-weight: bold;
    }
    </style>
@endpush

<button type="button" class="show-btn" data-bs-toggle="modal" data-bs-target="#exampleModal{{$id}}">
    <i class="fa-solid fa-eye"></i>
</button>
  
  
<div class="modal fade" id="exampleModal{{$id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    <span class="fw-bold">Order reference : </span>
                    <span class="text-secondary fw-bold">#{{$ref}}</span>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="clock-container">
                    <div>
                        @if ($meeting->order->status=='paid')
                            <a href="{{route('download-invoice',$meeting->order)}}" class="btn btn-md btn-outline-primary">
                                <i class="fa-solid fa-print"></i> print
                            </a>
                        @endif
                    </div>
                    <table class="order-infos-table mt-3"  >
                        <tbody>
                            <tr>
                                <td class="text-center">{{ __('Time meeting')}} </td>
                                <td class="text-center"><span class="text-secondary">{{ \Carbon\Carbon::parse($meeting->DateMeeting)->format('h:i A') }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">{{ __('Date meeting')}} </td>
                                <td class="text-center"><span class="text-secondary">{{ \Carbon\Carbon::parse($meeting->DateMeeting)->format('d/m/Y') }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">{{ __('Paid amount')}} </td>
                                <td class="text-center"><span class="text-primary">${{ number_format($meeting->order->paid_amount, 2) ?? '' }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">{{ __('Tax')}} </td>
                                <td class="text-center"><span class="text-danger">${{ number_format($meeting->order->tax, 2) ?? '' }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">{{ __('Status')}} </td>
                                <td class="text-center">
                                    @switch($meeting->order->status)
                                        @case('paid')
                                            <div class="meeting-status status-paid">{{$meeting->order->status}}</div>
                                        @break
            
                                        @case('canceled')
                                            <div class="meeting-status status-canceled">{{$meeting->order->status}}</i></div>
                                        @break
            
                                        @default
                                            <div class="meeting-status status-inprogress">{{$meeting->order->status}}</div>
                                    @endswitch
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
