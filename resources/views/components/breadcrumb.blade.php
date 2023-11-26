@props(['globalTitle', 'secondTitle'])
<!-- Start Breadcrumb 
============================================= -->
<div class="breadcrumb-area bg-cover shadow dark text-center text-light" 
    style="background-image: url({{ asset('storage/' . str_replace('\\', '/', setting('site.breadcrumb_img'))) }});background-size: contain;"
    >
    <div class="breadcrum-shape">
        <img src="{{asset('/img/shape/50.png')}}" alt="Image Not Found">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1>{!! $globalTitle !!}</h1>
                <ul class="breadcrumb">
                    <li><a href="{{route('home')}}"><i class="fas fa-home"></i> {{__('frontend.home')}}</a></li>
                    <li>{!! $secondTitle !!}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb -->