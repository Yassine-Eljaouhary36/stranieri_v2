<?php
    $firstServiceWithThumbnail = $servicesp->first(function ($service) {
        return !is_null($service->thumbnail);
    });
?>
@extends('layouts.app')
@section('content')

    <x-breadcrumb globalTitle="Our Services" secondTitle="Service" />
    
    @if (!$services->isEmpty())
    <!-- Start Aobut 
    ============================================= -->
    <div class="about-style-two-area overflow-hidden bg-contain default-padding" style="background-image: url({{asset('/img/shape/29.png')}});">
        <div class="container">
            <div class="row align-center">

                <div class="col-lg-5 about-style-two">
                    <div class="thumb">
                        @if ($firstServiceWithThumbnail->image && file_exists('storage/' . $firstServiceWithThumbnail->image))
                            <img src="{{ asset('storage/' . $firstServiceWithThumbnail->image) }}" alt="Image Not Found" title="{{ $firstServiceWithThumbnail->title }}">
                        @endif
                        @if ($firstServiceWithThumbnail->thumbnail && file_exists('storage/' . $firstServiceWithThumbnail->thumbnail))
                            <img src="{{ asset('storage/' . $firstServiceWithThumbnail->thumbnail) }}" alt="Thumbnail Not Found" title="{{ $firstServiceWithThumbnail->title }}">
                        @endif
                        <div class="experience">
                            <h2><strong>15</strong> Years experience</h2>
                        </div>
                        <div class="shape">
                            <img src="{{asset('/img/shape/anim-5.png')}}" alt="Shape">
                        </div>
                    </div>
                </div>

                <div class="about-style-two col-lg-6 offset-lg-1">
                    <h2 class="title">{{$firstServiceWithThumbnail->title}}</h2>
                    <p>
                        {!! $firstServiceWithThumbnail->body !!}
                    </p>
                    <div class="default-features mt-30">
                        <div class="default-feature-item">
                            <a href="#">
                                <i class="flaticon-investment-3"></i>
                            </a>
                        </div>
                        <div class="default-feature-item">
                            <a href="#">
                                <i class="flaticon-progress"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End About -->

    <!-- Start Services 
    ============================================= -->
    <div class="services-style-two-area default-padding bottom-less bg-cover bg-gray" style="background-image: url(assets/img/shape/27.png);">
        <div class="container">
            <div class="row">
                @foreach ($services as $service)
                    <!-- Single Item -->
                    <div class="col-xl-4 col-md-6 mb-30">
                        <div class="services-style-two active" style="height: 100%;overflow: hidden;">
                            <div class="thumb">
                                @if ($service->image && file_exists('storage/' . $service->image))
                                    <img style="width: 100%;overflow: hidden;object-fit: cover; height: 200px;" src="{{ asset('storage/' . $service->image) }}" alt="No picture" title="{{ $service->title }}">
                                @endif
                                <div class="title">
                                    <a href="{{ route('service', $service->slug) }}">
                                        <i class="{{$service->icon}}"></i>
                                        <h4>{{ $service->title }}</h4>
                                    </a>
                                </div>
                            </div>
                            <div class="info">
                                <p>
                                    {{ \Illuminate\Support\Str::limit($service->excerpt, 120 , '...') }}
                                </p>
                                <div class="button">
                                    <a href="{{ route('service', $service->slug) }}">Read More</a>
                                    <div class="devider"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                @endforeach
            </div>
            <div class="d-flex border-top mt-2">
                <div class="px-5 m-auto pt-2">
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- End Services -->
    @endif
    <x-about-us/>
    <x-choose-us/>
    <x-partners/>
    <x-team/>
    <x-cta/>
    <x-testimonails/>
@endsection