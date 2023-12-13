@extends('layouts.app')
@section('content')
@push('styles')
<style>
    .billing-address-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
    }

    .billing-address-table th, .billing-address-table td {
        padding: 5px 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    .billing-address-table tr td:first-child {
        background-color: #f0f0f0;
        font-weight: bold;
    }
    .cart-item {
        /* display: flex; */
        align-items: center;
        justify-content: space-between;
        padding: 20px 15px;  
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
        background-color: #fcfcfd;
        border: 1px solid #ccc;
        border-radius: 10px;
        margin: 0px 10px;
        /* overflow-x: auto; */
    }
    .service-select{
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
    }
    .service-selected{
        border-radius: 10px;
        box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;
        padding: 10px;
        display: flex;
        justify-content: space-between
    }
    @media screen and (max-width: 650px) {

        .cart-container{
            padding-left: 5px;
            padding-right: 5px;
        }
        .cart-item {
            flex-direction: column;
            padding: 10px; 
        }

    }
    @media screen and (max-width: 450px) {

        .cart-container{
            padding-left: 2px;
            padding-right: 2px;
        }
        .cart-item {
            padding: 8px; 
        }

    }

</style>
@endpush
<x-breadcrumb globalTitle="{{ __('meeting_order.Appointment_Details') }}" secondTitle="{{ __('meeting_order.Appointment_Details') }}" />
<div id="app" class="cart-container">

    
    <div class="appointment-details-header">
        <h1> {{ __('meeting_order.Appointment_Details') }}</h1>
    </div>
    @php
        // transilation
        $titleprice=__('meeting_order.Meeting_Price_Title');
        $titletime=__('meeting_order.Meeting_Time_Title');
        $titledate=__('meeting_order.Meeting_Date_Title');
    @endphp
    <div class="cart-item"  style="{{ app()->getLocale() == 'ar' ? "direction: rtl;" : "" }}">
    
        <div class="row text-secondary bg-light-subtle p-3">
            <div class="col-lg-8 col-sm-12 d-flex mb-3" style="align-items: center">
                {{-- @if (!$service) --}}
                    <select id="mySelect" class="service-select " aria-label="Default select example" onchange="selectService()">
                        <option value="0" selected>{{__('frontend.Choose_service')}}</option>
                        @foreach ( $services as $serviceItem)
                            <option value="{{$serviceItem->id}}" data-price="{{$serviceItem->price}}" data-duration="{{$serviceItem->duration}}" {{ $serviceItem->id == $service?->id ? "selected" : "" }}>{{$serviceItem->title}}</option>
                        @endforeach
                    </select>
                {{-- @else
                <div class="w-100 service-selected" style="{{ app()->getLocale() == 'ar' ? "flex-direction: row-reverse;" : "" }}">
                    <span class="text-secondary mr-2 fw-bold text-decoration-underline">{{__('frontend.service')}}</span>
                    <span>{{$service->title}}</span>       
                </div>

                @endif --}}
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="service-selected">
                    <span class="text-secondary mr-2 fw-bold text-decoration-underline">{{__('frontend.duration')}}</span>
                    <span id="duration">{{$service !== null ? $service->duration.'min' : '' }}</span>
                </div>
            </div>
        </div>
        <appointment-details 
            :local='@json($local)' 
            :price="{{$price}}"  
            :titleprice='@json($titleprice)' 
            :titletime='@json($titletime)' 
            :titledate='@json($titledate)' 
            ></appointment-details>

    </div>
    <div class="row mt-3 mx-2" style="{{ app()->getLocale() == 'ar' ? "direction: rtl;" : "" }}">
        <div style="{{ app()->getLocale() == 'ar' ? "margin-left: 15px" : "margin-right: 15px" }}" class="{{ app()->getLocale() == 'ar' ? "text-end" : "text-justify" }} col-md-5 col-lg-4 text-secondary bg-light-subtle custom-infos-space p-3 mr-3 mb-3">

            <div class=" py-1"><span class="text-secondary">{{ __('meeting_order.Discount') }} : </span><span class="text-secondary">{{setting('site.discount_percentage') ?? '0'}}%</span></div>
            <div class=" py-1"><span class="text-secondary">{{ __('meeting_order.You_Saved') }} </span><span class="text-secondary" id="amount-saved">${{ $data['totalDiscount'] }}</span></div>
            
            <div class=" py-1"><span> {{ __('meeting_order.Estimated_Tax') }} </span><span class="text-secondary" id="estimated-tax">${{ $data['estimatedTax'] }}</span></div>
            <div class=" py-1"><span> {{ __('meeting_order.Tax_Rate') }} </span><span class="text-secondary">{{ $data['taxRate'] }}%</span></div>
            <div class=" py-1"><span> {{ __('meeting_order.Total_Before_Tax') }} </span><span class="text-secondary" id="total-beforeTax">${{ $data['totalBeforeTax'] }}</span></div>
            <div class=" py-1 fw-bold"> {{ __('meeting_order.Order_Total') }} </span><span class="text-success" id="order-Total">${{ $data['orderTotal'] }}</span></div>
        </div>
        @auth('client')
            @if ($client->billingAddress)
                <div class="col text-secondary custom-infos-space p-3 bg-light-subtle  mx-sm-0 mb-3">
                    <h2 class="pb-1 border-bottom border-secondary">{{ __('meeting_order.Billing_Address') }}</h2>
                    <table class="billing-address-table mt-3"  >
                        <tbody>
                            <tr>
                                <td>{{ __('meeting_order.Address_One')}} </td>
                                <td><span class="text-secondary">{{ $client->billingAddress->address_one ?? '' }}</span></td>
                            </tr>
                            <tr>
                                <td>{{ __('meeting_order.Address_Two')}}</td>
                                <td><span class="text-secondary">{{ $client->billingAddress->address_two ?? '' }}</span></td>
                            </tr>
                            <tr>
                                <td>{{ __('meeting_order.Country')}}</td>
                                <td><span class="text-secondary" id="address-country">{{ $client->billingAddress->country ?? '' }}</span></td>
                            </tr>
                            <tr>
                                <td>{{ __('meeting_order.City')}}</td>
                                <td><span class="text-secondary">{{ $client->billingAddress->city ?? '' }}</span></td>
                            </tr>
                            <tr>
                                <td>{{ __('meeting_order.Zip_Code')}}</td>
                                <td><span class="text-secondary">{{ $client->billingAddress->zip ?? ''  }}</span></td>
                            </tr>
                            <tr>
                                <td>{{ __('meeting_order.Email')}}</td>
                                <td><span class="text-secondary">{{ $client->email ?? '' }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        @endauth  
    </div>

    <div class="mt-4 sm-2 d-grid gap-2 d-sm-flex flex-sm-row-reverse justify-content-sm-between">
        @auth('client')
            @if ($client->billingAddress)
                <button class="btn-custom btn-custom-primary " type="button" id="checkout-button">
                    {{ __('meeting_order.Checkout') }}
                    <i class="ml-1 fas fa-credit-card"></i>
                </button>
            @else
                <button class="btn-custom btn-custom-primary " type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus"></i>
                    {{ __('meeting_order.Billing_Address') }}
                </button>
            @endif
        @else
            <a class="btn-custom btn-custom-success " href="{{route('showRegistrationForm')}}">
                <i class="fas fa-user"></i>
               {{ __('register_login.register') }}
            </a>
        @endauth
        

        <a href="{{route('index')}}" class="btn-custom btn-custom-warning me-md-2" >
            <i class="mr-1 fas fa-arrow-left"></i>  {{ __('meeting_order.Back') }}
        </a>
    </div>
    @auth('client')
        @if ($client->billingAddress)
            <x-modal :client="$client" title="{{ __('meeting_order.Payment_Details') }}">
                <form class="card-form" action="{{route('pay-meeting')}}" method="post">
                    @csrf
                    <div class="mb-4">
                        <input type="hidden" name="payment_method" class="payment-method">
                        <input type="hidden" id="date-meeting" name="dateMeeting" value="{{$dateMeeting}}">
                        <input type="hidden" id="token_payment" name="token_payment" value="{{$token_payment}}">
                        <input type="text" class="form-control" id="card-holder-name" placeholder="Card holder name" required>
                        <p class="custom-text-danger" id="error-message"></p>
                    </div> 
                    <!-- Stripe Elements Placeholder -->
                    <div class="my-input-card" id="card-element"></div>
                </form>
            </x-modal>     

        @else
            <x-modal :client="$client" title="{{ __('meeting_order.Billing_Address') }}">
                <form class="address-form" action="{{route('billing-adress')}}" method="post" style="{{ app()->getLocale() == 'ar' ? "direction: rtl;" : "" }}">
                    @csrf
                    <div class="mb-3">
                        <label for="country" class="form-label">{{ __('meeting_order.country') }} <span class="text-danger">*</span></label>
                        @include('components.countrydropdown')
                    </div>
                    <div class="mb-3">
                        <label for="address_two" class="form-label">{{ __('meeting_order.Address_one') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="address_one" name="address_one">
                    </div>
                    <div class="mb-3">
                        <label for="address_two" class="form-label">{{ __('meeting_order.Address_two') }}</label>
                        <input type="text" class="form-control" id="address_two" name="address_two">
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">{{ __('meeting_order.city') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                    <div class="mb-3">
                        <label for="zip" class="form-label">{{ __('meeting_order.ZIP') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="zip" name="zip">
                    </div>
                </form>
            </x-modal>   
        @endif
    @endauth

@push('scripts')
    <script>
        function selectService(){
            const expirationDate = new Date();
            const priceText = document.querySelector('.item-price')
            const estimatedTaxText = document.querySelector('#estimated-tax')
            const amountSavedText = document.querySelector('#amount-saved')
            const totalBeforeTaxText = document.querySelector('#total-beforeTax')
            const orderTotalText = document.querySelector('#order-Total')
            const durationText = document.querySelector('#duration')

            var select = document.getElementById("mySelect");
            var selectedOption = select.options[select.selectedIndex];
            var serviceId = selectedOption.value
            if(serviceId == 0){
                priceText.textContent = currencyFormat(0);
                estimatedTaxText.textContent = currencyFormat(0);
                amountSavedText.textContent = currencyFormat(0);
                totalBeforeTaxText.textContent = currencyFormat(0);
                orderTotalText.textContent = currencyFormat(0);
                durationText.textContent= ''
                document.cookie = "serviceId=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            }else{
                expirationDate.setTime(expirationDate.getTime() + 24 * 60 * 60 * 1000); // Expires in 1 day
                document.cookie = `serviceId=${serviceId};expires=${expirationDate.toUTCString()}; path=/`;

                var originalPrice = selectedOption.dataset.price;
                var duration = selectedOption.dataset.duration;
            
                var formattedPrice = currencyFormat(originalPrice);
                var taxRate = {{$data['taxRate']/100}};

                var discountPercentage = isNumeric({{setting('site.discount_percentage')}}) ? {{setting('site.discount_percentage')}} : 0;
                var discountedPrice = originalPrice - (originalPrice * (discountPercentage / 100));
                var amountSaved = originalPrice - discountedPrice;
                var orderTotal = discountedPrice + (taxRate * discountedPrice);
                var estimatedTax = taxRate * discountedPrice;
                
                priceText.textContent = formattedPrice;
                estimatedTaxText.textContent = currencyFormat(estimatedTax);
                amountSavedText.textContent = currencyFormat(amountSaved);
                totalBeforeTaxText.textContent = currencyFormat(discountedPrice);
                orderTotalText.textContent = currencyFormat(orderTotal);
                durationText.textContent=duration+"min"
            }
         }

        function currencyFormat(value){
            var formattedValue = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            }).format(value);
            return formattedValue
        }

        function isNumeric(value) {
            return !isNaN(parseFloat(value)) && isFinite(value);
        }

        document.getElementById("checkout-button").addEventListener("click", function() {
            
            const myServiceIdCookieValue = getCookie('serviceId');
            const serviceSelect = document.querySelector('#mySelect');
            
            if (myServiceIdCookieValue === null) {
                Swal.fire("{{__('frontend.Choose_service')}}", "{{__('frontend.Choose_service')}}", 'warning');
            } else {
                $('#exampleModal').modal('show');
            }
        });

        function getCookie(name) {
            const cookies = document.cookie.split('; ').reduce((acc, cookie) => {
                const [key, value] = cookie.split('=');
                acc[key] = value;
                return acc;
            }, {});

            return cookies[name] || null;
        }

    </script>
@endpush
 
</div>
@endsection