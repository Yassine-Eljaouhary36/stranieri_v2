    <!-- Start Servics Style One 
    ============================================= -->
    <div class="services-style-one-area default-padding bg-gray">
        <div class="triangle-shape">
            <img src="{{asset('/img/shape/10.png')}}" alt="Shape">
        </div>
        <div class="center-shape" style="background-image: url({{asset('/img/shape/5.png')}});"></div>
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-5 mb-md-60">
                    <div class="service-nav-info">
                        <h4 class="sub-title">What we do</h4>
                        <h2>Excellent service and support for you</h2>
                        <div class="nav nav-tabs service-tab-navs" id="nav-tab" role="tablist">
                            @foreach (App()->servicesWithIncludedServices as $key => $service)
                                <button class="nav-link {{ $key === 0 ? 'active' : '' }}" id="nav-id-{{$key+1}}" data-bs-toggle="tab" data-bs-target="#tab{{$key+1}}" type="button" role="tab" aria-controls="tab{{$key+1}}" aria-selected="{{ $key === 0 ? 'active' : 'false' }}">
                                    <i class="{{$service->icon ?? ''}}"></i>
                                    {{$service->title ?? ''}}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 pl-50 pl-md-15 pl-xs-15">
                    <div class="tab-content services-tab-content" id="nav-tabContent">
                        @foreach (App()->servicesWithIncludedServices as $key => $service)
                            <!-- Tab Single Item -->
                            <div class="tab-pane fade {{ $key === 0 ? 'show active' : '' }}" id="tab{{$key+1}}" role="tabpanel" aria-labelledby="nav-id-{{$key+1}}">
                                <div class="row">
                                    @foreach ( $service->includedServices as $includedService )
                                        <!-- Single Item -->
                                        <div class="col-lg-6 col-md-6 mt-60 mt-md-30 mt-xs-30 {{ $key === 0 ? 'wow fadeInUp' : '' }}">
                                            <div class="services-style-one shadow-lg p-3 bg-body rounded">
                                                <h4><a href="services-single.html">{{$includedService->title}}</a></h4>
                                                <p>
                                                    Prevailed always tolerably discourse and loser assurance creatively coin applauded more uncommonly. Him everything trouble
                                                </p>
                                            </div>
                                        </div>
                                        <!-- End Single Item -->
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Tab Single Item -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services Style One -->