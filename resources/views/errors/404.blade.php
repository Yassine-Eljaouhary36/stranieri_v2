@extends('layouts.app')
@section('content')
        <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area bg-cover shadow dark text-center text-light" style="background-image: url(assets/img/2440x1578.png);">
        <div class="breadcrum-shape">
            <img src="{{asset('/img/shape/50.png')}}" alt="Image Not Found">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Error Page</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li>404</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start 404 
    ============================================= -->
    <div class="error-page-area default-padding text-center bg-cover">
        <!-- Shape -->
        <div class="shape-left" style="background: url({{asset('/img/shape/44-left.png')}});"></div>
        <div class="shape-right" style="background: url({{asset('/img/shape/44-right.png')}});"></div>
        <!-- End Shape -->
        <div class="container">
            <div class="error-box">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h1>404</h1>
                        <h2>Sorry Page Was Not Found!</h2>
                        <a class="btn mt-20 btn-md btn-theme" href="{{route('home')}}">Back to home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End 404 -->
@endsection