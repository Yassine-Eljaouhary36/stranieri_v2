@extends('layouts.app')
@section('content')
  
    <x-breadcrumb globalTitle="Frequently Asked Question" secondTitle="FAQ" />
    
    <!-- Start Faq Area 
    ============================================= -->
    <div class="faq-area bg-gray default-padding">
        <!-- End Shape -->
        <div class="container">
            <div class="row">
                @if (!$activeFaqs->isEmpty())
                    <div class="col-lg-4 mb-md-30 mb-xs-30">
                        <div class="faq-sidebar">
                            <div class="faq-sidebar-item bg-theme text-light" style="background-image: url({{asset('/img/shape/map-light.png')}};">
                                <h4>Need Help?</h4>
                                <ul>
                                    @foreach ($activeFaqs as $key => $faq)
                                        <li><a href="#heading{{$faq->id}}" data-bs-toggle="collapse" data-bs-target="#collapse{{$faq->id}}" aria-controls="collapse{{$faq->id}}"> {{$faq->question}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 faq-style-one dark pl-50 pl-md-15 pl-xs-15">
                        <h2 class="title mb-40">You need to know <br> before begin everything.</h2>
                        @include('components.website.faqs', ['activeFaqs' => $activeFaqs])
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- End Faq Area -->
@endsection