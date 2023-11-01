@php
    $string = setting('site.title') ?? '';
    $string = str_replace(' ', '', $string);
    $characters = str_split($string);

@endphp

<!-- Start Preloader 
============================================= -->
<div id="preloader">
    <div id="consua-preloader" class="consua-preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
                @foreach ( $characters as $character )
                   <span data-text-preloader="{{$character}}" class="letters-loading">
                        {{$character}}
                    </span> 
                @endforeach
            </div>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Preloader -->