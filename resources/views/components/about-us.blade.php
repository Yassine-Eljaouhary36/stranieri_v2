    <!-- Start About 
    ============================================= -->
    <div class="about-style-one-area default-padding">
        <div class="shape-animated-left">
            <img src="{{asset('/img/shape/anim-2.png')}}" alt="Image Not Found">
            <img src="{{asset('/img/shape/anim-1.png')}}" alt="Image Not Found">
        </div>
        <div class="container">
            <div class="row align-center">
                <div class="about-style-one col-xl-6 col-lg-5">
                    <div class="h4 sub-heading">{{App()->communication->title ?? ''}}</div>
                    <h2 class="title mb-25">{{App()->communication->excerpt ?? ''}}</h2>
                    <p>
                        {{App()->communication->about_us ?? ''}}
                    </p>
                    <div class="owner-info">
                        {{-- <div class="left-info">
                            <h4>Richard Garrett</h4>
                            <span>CEO & Founder</span>
                        </div> --}}
                        <div class="right-info">
                            <img src="{{asset('/img/signature.png')}}" alt="Image Not Found">
                        </div>
                    </div>
                </div>
                <div class="about-style-one col-xl-5 offset-xl-1 col-lg-6 offset-lg-1">
                    <div class="about-thumb">
                        @if (App()->communication->image && file_exists('storage/' . App()->communication->image))
                            <img class="wow fadeInRight" src="{{ asset('storage/' . App()->communication->image) }}" alt="Image Not Found">
                        @endif
                        <div class="about-card wow fadeInUp" data-wow-delay="500ms">
                            <ul>
                                <li>
                                    <div class="icon">
                                        <i class="flaticon-license"></i>
                                    </div>
                                    <div class="fun-fact">
                                        <div class="counter">
                                            <div class="timer" data-to="{{setting('site.Consulting_Success') ?? ''}}" data-speed="2000">{{setting('site.Consulting_Success') ?? ''}}</div>
                                            <div class="operator">%</div>
                                        </div>
                                        <span class="medium">Consulting Success</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="flaticon-global"></i>
                                    </div>
                                    <div class="fun-fact">
                                        <div class="counter">
                                            <div class="timer" data-to="{{setting('site.Worldwide_Clients') ?? ''}}" data-speed="2000">{{setting('site.Worldwide_Clients') ?? ''}}</div>
                                            <div class="operator">+</div>
                                        </div>
                                        <span class="medium">Worldwide Clients</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="thumb-shape-bottom wow fadeInDown" data-wow-delay="300ms">
                            <img src="{{asset('/img/shape/anim-4.png')}}" alt="Image Not Found">
                            <img src="{{asset('/img/shape/anim-3.png')}}" alt="Image Not Found">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About -->