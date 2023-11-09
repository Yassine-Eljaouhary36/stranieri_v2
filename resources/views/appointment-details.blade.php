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

    @media screen and (max-width: 650px) {

    .cart-container{
        padding-left: 5px;
        padding-right: 5px;
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
    <appointment-details 
        :local='@json($local)' 
        :price="{{$price}}"  
        :titleprice='@json($titleprice)' 
        :titletime='@json($titletime)' 
        :titledate='@json($titledate)' 
        ></appointment-details>

    <div class="row mt-3 mx-2">
        <div style="margin-right: 15px" class="{{ app()->getLocale() == 'ar' ? "text-end" : "text-justify" }} col-md-5 col-lg-4 text-secondary bg-light-subtle custom-infos-space p-3 mr-3 mb-3">

            @if (intVal($data['totalDiscount']) > 0)
                <div class=" py-1"><span class="text-secondary">{{ __('meeting_order.You_Saved') }} ${{ $data['totalDiscount'] }}</span></div>
            @endif
            <div class=" py-1"><span> {{ __('meeting_order.Estimated_Tax') }} </span><span class="text-secondary">${{ $data['estimatedTax'] }}</span></div>
            <div class=" py-1"><span> {{ __('meeting_order.Tax_Rate') }} </span><span class="text-secondary">{{ $data['taxRate'] }}%</span></div>
            <div class=" py-1"><span> {{ __('meeting_order.Total_Before_Tax') }} </span><span class="text-secondary">${{ $data['totalBeforeTax'] }}</span></div>
            <div class=" py-1 fw-bold"> {{ __('meeting_order.Order_Total') }} </span><span class="text-success">${{ $data['orderTotal'] }}</span></div>
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
                                <td><span class="text-secondary" id="address-country"></span></td>
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
                <button class="btn-custom btn-custom-primary " type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
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

            @push('scripts')
                <script>
                    const countriesData = [
                        {"name": "Albania", "code": "AL"},
                        {"name": "Åland Islands", "code": "AX"},
                        {"name": "Algeria", "code": "DZ"},
                        {"name": "American Samoa", "code": "AS"},
                        {"name": "Andorra", "code": "AD"},
                        {"name": "Angola", "code": "AO"},
                        {"name": "Anguilla", "code": "AI"},
                        {"name": "Antarctica", "code": "AQ"},
                        {"name": "Antigua and Barbuda", "code": "AG"},
                        {"name": "Argentina", "code": "AR"},
                        {"name": "Armenia", "code": "AM"},
                        {"name": "Aruba", "code": "AW"},
                        {"name": "Australia", "code": "AU"},
                        {"name": "Austria", "code": "AT"},
                        {"name": "Azerbaijan", "code": "AZ"},
                        {"name": "Bahamas (the)", "code": "BS"},
                        {"name": "Bahrain", "code": "BH"},
                        {"name": "Bangladesh", "code": "BD"},
                        {"name": "Barbados", "code": "BB"},
                        {"name": "Belarus", "code": "BY"},
                        {"name": "Belgium", "code": "BE"},
                        {"name": "Belize", "code": "BZ"},
                        {"name": "Benin", "code": "BJ"},
                        {"name": "Bermuda", "code": "BM"},
                        {"name": "Bhutan", "code": "BT"},
                        {"name": "Bolivia (Plurinational State of)", "code": "BO"},
                        {"name": "Bonaire, Sint Eustatius and Saba", "code": "BQ"},
                        {"name": "Bosnia and Herzegovina", "code": "BA"},
                        {"name": "Botswana", "code": "BW"},
                        {"name": "Bouvet Island", "code": "BV"},
                        {"name": "Brazil", "code": "BR"},
                        {"name": "British Indian Ocean Territory (the)", "code": "IO"},
                        {"name": "Brunei Darussalam", "code": "BN"},
                        {"name": "Bulgaria", "code": "BG"},
                        {"name": "Burkina Faso", "code": "BF"},
                        {"name": "Burundi", "code": "BI"},
                        {"name": "Cabo Verde", "code": "CV"},
                        {"name": "Cambodia", "code": "KH"},
                        {"name": "Cameroon", "code": "CM"},
                        {"name": "Canada", "code": "CA"},
                        {"name": "Cayman Islands (the)", "code": "KY"},
                        {"name": "Central African Republic (the)", "code": "CF"},
                        {"name": "Chad", "code": "TD"},
                        {"name": "Chile", "code": "CL"},
                        {"name": "China", "code": "CN"},
                        {"name": "Christmas Island", "code": "CX"},
                        {"name": "Cocos (Keeling) Islands (the)", "code": "CC"},
                        {"name": "Colombia", "code": "CO"},
                        {"name": "Comoros (the)", "code": "KM"},
                        {"name": "Congo (the Democratic Republic of the)", "code": "CD"},
                        {"name": "Congo (the)", "code": "CG"},
                        {"name": "Cook Islands (the)", "code": "CK"},
                        {"name": "Costa Rica", "code": "CR"},
                        {"name": "Croatia", "code": "HR"},
                        {"name": "Cuba", "code": "CU"},
                        {"name": "Curaçao", "code": "CW"},
                        {"name": "Cyprus", "code": "CY"},
                        {"name": "Czechia", "code": "CZ"},
                        {"name": "Côte d'Ivoire", "code": "CI"},
                        {"name": "Denmark", "code": "DK"},
                        {"name": "Djibouti", "code": "DJ"},
                        {"name": "Dominica", "code": "DM"},
                        {"name": "Dominican Republic (the)", "code": "DO"},
                        {"name": "Ecuador", "code": "EC"},
                        {"name": "Egypt", "code": "EG"},
                        {"name": "El Salvador", "code": "SV"},
                        {"name": "Equatorial Guinea", "code": "GQ"},
                        {"name": "Eritrea", "code": "ER"},
                        {"name": "Estonia", "code": "EE"},
                        {"name": "Eswatini", "code": "SZ"},
                        {"name": "Ethiopia", "code": "ET"},
                        {"name": "Falkland Islands (the) [Malvinas]", "code": "FK"},
                        {"name": "Faroe Islands (the)", "code": "FO"},
                        {"name": "Fiji", "code": "FJ"},
                        {"name": "Finland", "code": "FI"},
                        {"name": "France", "code": "FR"},
                        {"name": "French Guiana", "code": "GF"},
                        {"name": "French Polynesia", "code": "PF"},
                        {"name": "French Southern Territories (the)", "code": "TF"},
                        {"name": "Gabon", "code": "GA"},
                        {"name": "Gambia (the)", "code": "GM"},
                        {"name": "Georgia", "code": "GE"},
                        {"name": "Germany", "code": "DE"},
                        {"name": "Ghana", "code": "GH"},
                        {"name": "Gibraltar", "code": "GI"},
                        {"name": "Greece", "code": "GR"},
                        {"name": "Greenland", "code": "GL"},
                        {"name": "Grenada", "code": "GD"},
                        {"name": "Guadeloupe", "code": "GP"},
                        {"name": "Guam", "code": "GU"},
                        {"name": "Guatemala", "code": "GT"},
                        {"name": "Guernsey", "code": "GG"},
                        {"name": "Guinea", "code": "GN"},
                        {"name": "Guinea-Bissau", "code": "GW"},
                        {"name": "Guyana", "code": "GY"},
                        {"name": "Haiti", "code": "HT"},
                        {"name": "Heard Island and McDonald Islands", "code": "HM"},
                        {"name": "Holy See (the)", "code": "VA"},
                        {"name": "Honduras", "code": "HN"},
                        {"name": "Hong Kong", "code": "HK"},
                        {"name": "Hungary", "code": "HU"},
                        {"name": "Iceland", "code": "IS"},
                        {"name": "India", "code": "IN"},
                        {"name": "Indonesia", "code": "ID"},
                        {"name": "Iran (Islamic Republic of)", "code": "IR"},
                        {"name": "Iraq", "code": "IQ"},
                        {"name": "Ireland", "code": "IE"},
                        {"name": "Isle of Man", "code": "IM"},
                        {"name": "Israel", "code": "IL"},
                        {"name": "Italy", "code": "IT"},
                        {"name": "Jamaica", "code": "JM"},
                        {"name": "Japan", "code": "JP"},
                        {"name": "Jersey", "code": "JE"},
                        {"name": "Jordan", "code": "JO"},
                        {"name": "Kazakhstan", "code": "KZ"},
                        {"name": "Kenya", "code": "KE"},
                        {"name": "Kiribati", "code": "KI"},
                        {"name": "Korea (the Democratic People's Republic of)", "code": "KP"},
                        {"name": "Korea (the Republic of)", "code": "KR"},
                        {"name": "Kuwait", "code": "KW"},
                        {"name": "Kyrgyzstan", "code": "KG"},
                        {"name": "Lao People's Democratic Republic (the)", "code": "LA"},
                        {"name": "Latvia", "code": "LV"},
                        {"name": "Lebanon", "code": "LB"},
                        {"name": "Lesotho", "code": "LS"},
                        {"name": "Liberia", "code": "LR"},
                        {"name": "Libya", "code": "LY"},
                        {"name": "Liechtenstein", "code": "LI"},
                        {"name": "Lithuania", "code": "LT"},
                        {"name": "Luxembourg", "code": "LU"},
                        {"name": "Macao", "code": "MO"},
                        {"name": "Madagascar", "code": "MG"},
                        {"name": "Malawi", "code": "MW"},
                        {"name": "Malaysia", "code": "MY"},
                        {"name": "Maldives", "code": "MV"},
                        {"name": "Mali", "code": "ML"},
                        {"name": "Malta", "code": "MT"},
                        {"name": "Marshall Islands (the)", "code": "MH"},
                        {"name": "Martinique", "code": "MQ"},
                        {"name": "Mauritania", "code": "MR"},
                        {"name": "Mauritius", "code": "MU"},
                        {"name": "Mayotte", "code": "YT"},
                        {"name": "Mexico", "code": "MX"},
                        {"name": "Micronesia (Federated States of)", "code": "FM"},
                        {"name": "Moldova (the Republic of)", "code": "MD"},
                        {"name": "Monaco", "code": "MC"},
                        {"name": "Mongolia", "code": "MN"},
                        {"name": "Montenegro", "code": "ME"},
                        {"name": "Montserrat", "code": "MS"},
                        {"name": "Morocco", "code": "MA"},
                        {"name": "Mozambique", "code": "MZ"},
                        {"name": "Myanmar", "code": "MM"},
                        {"name": "Namibia", "code": "NA"},
                        {"name": "Nauru", "code": "NR"},
                        {"name": "Nepal", "code": "NP"},
                        {"name": "Netherlands (the)", "code": "NL"},
                        {"name": "New Caledonia", "code": "NC"},
                        {"name": "New Zealand", "code": "NZ"},
                        {"name": "Nicaragua", "code": "NI"},
                        {"name": "Niger (the)", "code": "NE"},
                        {"name": "Nigeria", "code": "NG"},
                        {"name": "Niue", "code": "NU"},
                        {"name": "Norfolk Island", "code": "NF"},
                        {"name": "Northern Mariana Islands (the)", "code": "MP"},
                        {"name": "Norway", "code": "NO"},
                        {"name": "Oman", "code": "OM"},
                        {"name": "Pakistan", "code": "PK"},
                        {"name": "Palau", "code": "PW"},
                        {"name": "Palestine, State of", "code": "PS"},
                        {"name": "Panama", "code": "PA"},
                        {"name": "Papua New Guinea", "code": "PG"},
                        {"name": "Paraguay", "code": "PY"},
                        {"name": "Peru", "code": "PE"},
                        {"name": "Philippines (the)", "code": "PH"},
                        {"name": "Pitcairn", "code": "PN"},
                        {"name": "Poland", "code": "PL"},
                        {"name": "Portugal", "code": "PT"},
                        {"name": "Puerto Rico", "code": "PR"},
                        {"name": "Qatar", "code": "QA"},
                        {"name": "Republic of North Macedonia", "code": "MK"},
                        {"name": "Romania", "code": "RO"},
                        {"name": "Russian Federation (the)", "code": "RU"},
                        {"name": "Rwanda", "code": "RW"},
                        {"name": "Réunion", "code": "RE"},
                        {"name": "Saint Barthélemy", "code": "BL"},
                        {"name": "Saint Helena, Ascension and Tristan da Cunha", "code": "SH"},
                        {"name": "Saint Kitts and Nevis", "code": "KN"},
                        {"name": "Saint Lucia", "code": "LC"},
                        {"name": "Saint Martin (French part)", "code": "MF"},
                        {"name": "Saint Pierre and Miquelon", "code": "PM"},
                        {"name": "Saint Vincent and the Grenadines", "code": "VC"},
                        {"name": "Samoa", "code": "WS"},
                        {"name": "San Marino", "code": "SM"},
                        {"name": "Sao Tome and Principe", "code": "ST"},
                        {"name": "Saudi Arabia", "code": "SA"},
                        {"name": "Senegal", "code": "SN"},
                        {"name": "Serbia", "code": "RS"},
                        {"name": "Seychelles", "code": "SC"},
                        {"name": "Sierra Leone", "code": "SL"},
                        {"name": "Singapore", "code": "SG"},
                        {"name": "Sint Maarten (Dutch part)", "code": "SX"},
                        {"name": "Slovakia", "code": "SK"},
                        {"name": "Slovenia", "code": "SI"},
                        {"name": "Solomon Islands", "code": "SB"},
                        {"name": "Somalia", "code": "SO"},
                        {"name": "South Africa", "code": "ZA"},
                        {"name": "South Georgia and the South Sandwich Islands", "code": "GS"},
                        {"name": "South Sudan", "code": "SS"},
                        {"name": "Spain", "code": "ES"},
                        {"name": "Sri Lanka", "code": "LK"},
                        {"name": "Sudan (the)", "code": "SD"},
                        {"name": "Suriname", "code": "SR"},
                        {"name": "Svalbard and Jan Mayen", "code": "SJ"},
                        {"name": "Sweden", "code": "SE"},
                        {"name": "Switzerland", "code": "CH"},
                        {"name": "Syrian Arab Republic", "code": "SY"},
                        {"name": "Taiwan (Province of China)", "code": "TW"},
                        {"name": "Tajikistan", "code": "TJ"},
                        {"name": "Tanzania, United Republic of", "code": "TZ"},
                        {"name": "Thailand", "code": "TH"},
                        {"name": "Timor-Leste", "code": "TL"},
                        {"name": "Togo", "code": "TG"},
                        {"name": "Tokelau", "code": "TK"},
                        {"name": "Tonga", "code": "TO"},
                        {"name": "Trinidad and Tobago", "code": "TT"},
                        {"name": "Tunisia", "code": "TN"},
                        {"name": "Turkey", "code": "TR"},
                        {"name": "Turkmenistan", "code": "TM"},
                        {"name": "Turks and Caicos Islands (the)", "code": "TC"},
                        {"name": "Tuvalu", "code": "TV"},
                        {"name": "Uganda", "code": "UG"},
                        {"name": "Ukraine", "code": "UA"},
                        {"name": "United Arab Emirates (the)", "code": "AE"},
                        {"name": "United Kingdom of Great Britain and Northern Ireland (the)", "code": "GB"},
                        {"name": "United States Minor Outlying Islands (the)", "code": "UM"},
                        {"name": "United States of America (the)", "code": "US"},
                        {"name": "Uruguay", "code": "UY"},
                        {"name": "Uzbekistan", "code": "UZ"},
                        {"name": "Vanuatu", "code": "VU"},
                        {"name": "Venezuela (Bolivarian Republic of)", "code": "VE"},
                        {"name": "Viet Nam", "code": "VN"},
                        {"name": "Virgin Islands (British)", "code": "VG"},
                        {"name": "Virgin Islands (U.S.)", "code": "VI"},
                        {"name": "Wallis and Futuna", "code": "WF"},
                        {"name": "Western Sahara", "code": "EH"},
                        {"name": "Yemen", "code": "YE"},
                        {"name": "Zambia", "code": "ZM"},
                        {"name": "Zimbabwe", "code": "ZW"}
                        ]
                        const addressCountry = document.getElementById('address-country');
                        const country = countriesData.find(item => item.code === "{{ $client->billingAddress->country }}");
                        addressCountry.textContent =  country ? country.name+" "+country.code : "{{ $client->billingAddress->country }}";
                </script>
            @endpush
        @else
            <x-modal :client="$client" title="{{ __('Billing Address') }}">
                <form class="address-form" action="{{route('billing-adress')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        @include('components.countrydropdown')
                    </div>
                    <div class="mb-3">
                        <label for="address_two" class="form-label">Address 1</label>
                        <input type="text" class="form-control" id="address_one" name="address_one">
                    </div>
                    <div class="mb-3">
                        <label for="address_two" class="form-label">Address 2</label>
                        <input type="text" class="form-control" id="address_two" name="address_two">
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                    <div class="mb-3">
                        <label for="zip" class="form-label">ZIP Code</label>
                        <input type="text" class="form-control" id="zip" name="zip">
                    </div>
                </form>
            </x-modal>   
        @endif
    @endauth


 
</div>
@endsection