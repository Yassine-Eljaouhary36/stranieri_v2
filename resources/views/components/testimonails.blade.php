@if(!App()->testimonials->isEmpty())
<!-- Start Testimonials 
============================================= -->
<div class="testimonial-style-one-area default-padding">
    <div class="container">
        <div class="row align-center">
            <div class="col-lg-4">
                <div class="thumb-item p-5">
                    <img src="{{ asset('img/testimonials.png') }}" alt="illustration" class="h-100 w-100">
                    <div class="mini-shape">
                        <img src="{{ asset('img/shape/19-blue.png') }}" alt="illustration"
                            style="    transform: rotate3d(1, 1, 1, 45deg);">
                    </div>
                </div>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <div class="testimonial-carousel swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        @foreach (App()->testimonials as $testimonial)
                        <!-- Single item -->
                        <div class="swiper-slide">
                            <div class="testimonial-style-one">
                                
                                <div class="item">
                                    <div class="content">
                                        <p>
                                            “{{$testimonial->content ?? ''}}”
                                        </p>
                                    </div>
                                    <div class="provider">
                                        <i class="flaticon-quote"></i>
                                        <div class="info">
                                            <h4>{{$testimonial->author_name ?? ''}}</h4>
                                            <span>{{$testimonial->author_title ?? ''}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single item -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Testimonails  -->
@endif