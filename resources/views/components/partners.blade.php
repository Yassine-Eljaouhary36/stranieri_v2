@if (!App()->partners->isEmpty())
@php
    // Retrieve active partners from the 'partners' singleton
    $activePartners = collect(App()->partners)->where('active', true)->take(6);
@endphp
<!-- Start Partner Area  
============================================= -->
<div class="partner-style-one-area default-padding">
    <div class="container">
        <div class="row align-center">
            <div class="col-lg-5">
                <div class="partner-map text-center" style="background-image: url({{asset('/img/shape/map.png')}});">
                    <h2 class="mask-text" style="background-color: #737373;">{{setting('site.Number_partners') ?? ''}}</h2>
                    <h4>{{__('frontend.partners')}}</h4>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1">
                <div class="partner-items">
                    <ul>
                        @foreach ($activePartners as $partner)
                            @if ($partner->logo && file_exists('storage/' . $partner->logo))
                                <li><img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" title="{{ $partner->name }}"></li>
                            @endif   
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Partner Area -->
@endif