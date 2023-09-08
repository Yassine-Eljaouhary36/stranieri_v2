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
        border-radius: 10px;
    }

    /* .status-paid {
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
    } */

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
                    <span class="fw-bold">{{ __('meeting_order.Order_Reference')}}</span>
                    <span class="text-secondary fw-bold">#{{$ref}}</span>
                </h1>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <div class="clock-container">
                    <div>
                        @if ($meeting->order->status=='paid')
                            <a href="{{route('download-invoice',$meeting->order)}}" class="btn btn-md btn-outline-primary">
                                <i class="fa-solid fa-print"></i> {{ __('meeting_order.Print')}}
                            </a>
                        @endif
                    </div>
                    <table class="order-infos-table mt-3"  >
                        <tbody>
                            <tr>
                                <td class="text-center">{{ __('meeting_order.Time_Meeting')}} </td>
                                <td class="text-center"><span class="text-secondary">{{ \Carbon\Carbon::parse($meeting->DateMeeting)->format('h:i A') }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">{{ __('meeting_order.Date_Meeting')}} </td>
                                <td class="text-center"><span class="text-secondary">{{ \Carbon\Carbon::parse($meeting->DateMeeting)->format('d/m/Y') }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">{{ __('meeting_order.Paid_Amount')}} </td>
                                <td class="text-center"><span class="text-primary">${{ number_format($meeting->order->paid_amount, 2) ?? '' }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">{{ __('meeting_order.Tax')}} </td>
                                <td class="text-center"><span class="text-danger">${{ number_format($meeting->order->tax, 2) ?? '' }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">{{ __('meeting_order.Status')}} </td>
                                <td class="text-center">
                                    @switch($meeting->order->status)
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
                                            <div class="meeting-status default">{{$meeting->order->status}}</div>
                                    @endswitch
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('meeting_order.Close')}}</button>
            </div>
        </div>
    </div>
</div>
