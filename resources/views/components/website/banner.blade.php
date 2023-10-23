<!-- Start Banner Area 
============================================= -->
<div class="banner-area banner-style-one shadow navigation-custom-large zoom-effect overflow-hidden text-light">
    <!-- Slider main container -->
    <div class="banner-fade">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            @foreach ( App()->offers as $offer )
                <!-- Single Item -->
                <div class="swiper-slide banner-style-one">
                    <div class="banner-thumb bg-cover shadow dark" style="background: url({{ asset('storage/' . str_replace( '\\' , '/' ,$offer->image) ) }});"></div>
                    <div class="container">
                        <div class="row align-center">
                            <div class="col-xl-7 offset-xl-5">
                                <div class="content">
                                    <h4>{{ \Illuminate\Support\Str::limit($offer->title ?? '', 50 , '...')}}</h4>
                                    <h2><strong>{{ \Illuminate\Support\Str::limit($offer->excerpt, 32 , '...') }}</strong></h2>
                                    <div class="button mt-40">
                                        <a class="btn-animation" href="#"><i class="fas fa-arrow-right"></i> <span>See Offer</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shape -->
                    <div class="banner-shape-bg">
                        <img src="{{asset('/img/shape/4.png')}}" alt="Shape">
                    </div>
                    <!-- End Shape -->
                </div>
                <!-- End Single Item -->
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>  
</div>
<!-- End Main -->