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
    </style>
@endpush

<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$id}}">
    <i class="fa-solid fa-clock"></i>
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
                    <div class="time fw-bold" id="timeDisplay">{{ \Carbon\Carbon::parse($meeting->DateMeeting)->format('h:i A') }}</div>
                    <div class="date text-secondary" id="dateDisplay">{{ \Carbon\Carbon::parse($meeting->DateMeeting)->format('d/m/Y') }}</div>
                    <div class="mt-2">
                        @switch($meeting->status)
                            @case('paid')
                                <div class="meeting-status status-paid">{{$meeting->status}}</div>
                            @break

                            @case('canceled')
                                <div class="meeting-status status-canceled">{{$meeting->status}}</i></div>
                            @break

                            @default
                                <div class="meeting-status status-inprogress">{{$meeting->status}}</div>
                        @endswitch
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
