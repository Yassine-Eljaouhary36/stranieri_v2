@extends('layouts.app')
@section('content')
<div class="cart-container">
    <appointment-details :discount="{{ $discount }}" :price="{{$price}}" ></appointment-details>


    <!-- Button trigger modal -->

    <div class="mt-4 sm-2 d-grid gap-2 d-sm-flex flex-sm-row-reverse justify-content-sm-between">
        <button class="btn-custom btn-custom-primary " type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
            checkout 
            <i class="ml-1 fa-solid fa-credit-card"></i>
        </button>
        <a href="{{route('index')}}" class="btn-custom btn-custom-warning me-md-2" >
            <i class="mr-1 fa-solid fa-arrow-left"></i> back
        </a>
    </div>

    <!-- Modal -->
    <x-modal title="Payment details">
        <form class="card-form" action="{{route('pay-meeting')}}" method="post">
            @csrf
            <div class="mb-4">
                <input type="hidden" name="payment_method" class="payment-method">
                <input type="hidden" id="date-meeting" name="dateMeeting" value="{{$dateMeeting}}">
                <input type="text" class="form-control" id="card-holder-name" placeholder="Card holder name" required>
                <p class="custom-text-danger" id="error-message"></p>
            </div> 
            <!-- Stripe Elements Placeholder -->
            <div class="my-input-card" id="card-element"></div>
        </form>
    </x-modal>
 
</div>
@endsection