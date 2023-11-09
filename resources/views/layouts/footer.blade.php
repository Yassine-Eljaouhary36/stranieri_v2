<!-- Start Footer 
============================================= -->
<footer class="bg-dark text-light">
    <div class="footer-shape">
        <div class="item">
            <img src="{{asset('/img/shape/7.png')}}" alt="Shape">
        </div>
        <div class="item">
            <img src="{{asset('/img/shape/9.png')}}" alt="Shape">
        </div>
    </div>
    <div class="container">
        <div class="f-items relative pt-70 pb-120 pt-xs-0 pb-xs-50">
            <div class="row">
                <div class="col-lg-4 col-md-6 footer-item pr-50 pr-xs-15">
                    <div class="f-item about">
                        {{-- @if (setting('site.logo') && file_exists('storage/' . setting('site.logo'))) --}}
                            <img class="logo" src="{{ asset('storage/' . setting('site.logo')) }}" alt="Logo">
                        {{-- @endif --}}
                        <p>
                            {{ \Illuminate\Support\Str::limit(App()->communication->about_us ?? '', 190 , '...')}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 footer-item">
                    <div class="f-item link">
                        <h4 class="widget-title">{{__('frontend.quick_links')}}</h4>
                        <ul>
                            @foreach ( App()->pages as $page )
                                <li>
                                    <a href="{{route('page',$page->slug)}}">{{$page->title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 footer-item">
                    <div class="f-item link">
                        <h4 class="widget-title">{{__('frontend.services')}}</h4>
                        <ul>
                            @foreach ( App()->services as $service)
                                <li>
                                    <a href="{{ route('service', $service->slug) }}">{{ $service->title }}</a>
                                </li>  
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 footer-item">
                    <div class="opening-hours">
                        <h4 class="widget-title">{{__('frontend.opening_hours')}}</h4>
                        <ul>
                            <li> 
                                <div class="working-day">{{App()->communication->workingtime ?? ''}}</div>
                            </li>
                        </ul>
                    </div>
                    <ul class="footer-social">
                        <li>
                            <a href="{{App()->communication->instagram ?? ''}}">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{App()->communication->pinterest ?? ''}}">
                                <i class="fab fa-pinterest-square"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{App()->communication->youtube ?? ''}}">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{App()->communication->linkedin ?? ''}}">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p>&copy; {{__('frontend.copyright')}} <a href="{{route('home')}}">{{setting('site.title') ?? ''}}</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Bottom -->

</footer>
<!-- End Footer -->