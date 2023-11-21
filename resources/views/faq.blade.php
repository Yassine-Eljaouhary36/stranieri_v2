@extends('layouts.app')
@section('content')
  
    <x-breadcrumb globalTitle="{{__('frontend.frequently_asked_question')}}" secondTitle="{{__('frontend.frequently_asked_question')}}" />
    
    <!-- Start Faq Area 
    ============================================= -->
    <div class="faq-area bg-gray default-padding">
        <!-- End Shape -->
        <div class="container">
            <div class="row">
                @if (!$activeFaqs->isEmpty())
                    <div class="col-lg-4 mb-md-30 mb-xs-30">
                        <div class="faq-sidebar" style="{{ app()->getLocale() == 'ar' ? "direction: rtl;" : "" }}">
                            <div class="faq-sidebar-item bg-theme text-light" style="background-image: url({{asset('/img/shape/map-light.png')}};">
                                <h4>{{__('frontend.need_help')}}</h4>
                                <ul>
                                    @foreach ($activeFaqs as $key => $faq)
                                        <li><a href="#heading{{$faq->id}}" data-bs-toggle="collapse" data-bs-target="#collapse{{$faq->id}}" aria-controls="collapse{{$faq->id}}"> {{$faq->question}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 faq-style-one dark pl-50 pl-md-15 pl-xs-15" style="{{ app()->getLocale() == 'ar' ? "direction: rtl;" : "" }}">
                        <h2 class="title mb-40">{{__('frontend.you_need_to_know')}}</h2>
                        @include('components.website.faqs', ['activeFaqs' => $activeFaqs])
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- End Faq Area -->
@endsection