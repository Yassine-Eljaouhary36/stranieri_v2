<?php  
    $topTwoRatedServices = $services->sortByDesc('rate')->take(2);
?>
@extends('layouts.app')
@section('content')

    <x-breadcrumb globalTitle="Service Details" secondTitle="Service" />

    <!-- Star Services Details Area
    ============================================= -->
    <div class="services-details-area overflow-hidden default-padding">
        <div class="container">
            <div class="services-details-items">
                <div class="row">
                    
                    <div class="col-xl-8 col-lg-7 order-lg-last ">
                        <div class="thumb">
                            @if ($service->image && file_exists('storage/' . $service->image))
                                <img style="width: 100% ; max-height: 500px" src="{{ asset('storage/' . $service->image) }}" alt="No picture" title="{{ $service->title }}">
                            @endif
                        </div>
                        <h2>{{ $service->title }}</h2>
                        <p>
                            {!! $service->body !!}
                        </p>
                        @foreach ($service->includedServices as $includedService)
                            @php
                                // Split the string into an array using the new line character "\n" as the delimiter
                                $linesArray = explode("\n", $includedService->body);
                            @endphp
                            <div class="content" id="includedService_{{$includedService->id}}">
                                <h3>{{$includedService->title}}</h3>
                                <ul class="feature-list-item">
                                    @foreach ( $linesArray as $line )
                                    <li>{{$line}}</li>    
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                        @if (!$activeFaqs->isEmpty())    
                            <div class="faq-style-one dark mt-40">
                                <h3 class="mb-30">Common Question for this project</h3>
                                @include('components.website.faqs', ['activeFaqs' => $activeFaqs])
                            </div>
                        @endif
                        <div class="services-more mt-40">
                            <h2>Popular Services</h2>
                            <div class="row">
                                @foreach ($topTwoRatedServices as $topService )
                                    <div class="col-md-6">
                                        <div class="item">
                                            <i class="{{$topService->icon}}"></i>
                                            <h4><a href="{{ route('service', $topService->slug) }}">{{$topService->title}}</a></h4>
                                            <p>
                                                {{$topService->excerpt}}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-5 mt-md-120 mt-xs-50 services-sidebar">
                        @if(!$service->includedServices->isEmpty())
                            <!-- Single Widget -->
                            <div class="single-widget services-list-widget">
                                <h4 class="widget-title">included Services</h4>
                                <div class="content">
                                    <ul>
                                        @foreach ($service->includedServices as $includedService)
                                            <li><a href="#includedService_{{$includedService->id}}">{{$includedService->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- End Single Widget -->
                        @endif
                        <div class="single-widget bg-dark quick-contact-widget text-light" style="background-image: url(assets/img/shape/15.png);">
                            <div class="content">
                                <h3>Need Help?</h3>
                                <h2><a href="tel:{{ App()->communication->phone }}"> {{ App()->communication->phone }}</a></h2>
                                <h4>   <a href="mailto:{{ App()->communication->email }}">
                                    {{ App()->communication->email }}
                                </a></h4>
                                <a class="btn mt-30 circle btn-sm btn-gradient" href="route('show-contact')">Contact Us</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Services Details Area -->
@endsection