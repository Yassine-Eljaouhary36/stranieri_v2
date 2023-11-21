@php
    $jsonString = setting('site.Choose_Us_Text');
    $dataArray = json_decode($jsonString, true);
    $data = $dataArray['data'];

    $desiredLang = app()->getLocale();
    $desiredItem = null;

    foreach ($dataArray['data'] as $item) {
        if ($item['lang'] === $desiredLang) {
            $desiredItem = $item;
        }
    }
@endphp

<!-- Start Why Choose Us
    ============================================= -->
    <div class="choose-us-style-one-area default-padding text-light">
        @if (setting('site.Choose_Us_Image') && file_exists('storage/' . setting('site.Choose_Us_Image')))
            <div class="cover-bg" style="background-image: url({{ asset('storage/' . str_replace( '\\' , '/' , setting('site.Choose_Us_Image')) ) }});"></div>
        @endif
        <div class="shape-left-top">
            <img src="{{asset('/img/shape/17.png')}}" alt="Shape">
        </div>
        {{-- <div class="text-invisible">Consua</div> --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pr-80">
                    <div class="choose-us-style-one">
                        <h2 class="title mb-35">{{ \Illuminate\Support\Str::limit($desiredItem['title']?? '', 45 , '...')}}</h2>
                        <ul class="list-item">
                            <li class="wow fadeInUp" data-wow-delay="300ms">
                                <h4>{{ \Illuminate\Support\Str::limit($desiredItem['subtitle'] ?? '', 35 , '...')}}</h4>
                                <p>
                                    {{ \Illuminate\Support\Str::limit($desiredItem['description'] ?? '', 200 , '...')}}
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Why Choose Us -->