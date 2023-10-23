@extends('layouts.app')
@section('content')
    <x-breadcrumb globalTitle="Contact Us" secondTitle="Contact" />

        <!-- Start Contact Us 
    ============================================= -->
    <div class="contact-style-one-area overflow-hidden default-padding">

        <div class="contact-shape">
            <img src="{{asset('/img/shape/37.png')}}" alt="Image Not Found">
        </div>
       
        <div class="container">
            <div class="row align-center">

                <div class="contact-stye-one col-lg-5 mb-md-50 mb-xs-20">

                    <div class="contact-style-one-info">
                        <h2>Contact Information</h2>
                        <ul>
                            <li class="wow fadeInUp">
                                <div class="icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="content">
                                    <h5 class="title">Hotline</h5>
                                    <a href="tel:+{{App()->communication->phone ?? ''}}">{{App()->communication->phone ?? ''}}</a>
                                </div>
                            </li>
                            <li class="wow fadeInUp" data-wow-delay="300ms">
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Our Location</h5>
                                    <p>
                                        {{App()->communication->address ?? ''}}
                                    </p>
                                </div>
                            </li>
                            <li class="wow fadeInUp" data-wow-delay="500ms">
                                <div class="icon">
                                    <i class="fas fa-envelope-open-text"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Official Email</h5>
                                    <a href="mailto:tel:+{{App()->communication->email ?? ''}}">tel:+{{App()->communication->email ?? ''}}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="contact-stye-one col-lg-7 pl-60 pl-md-15 pl-xs-15">
                    <div class="contact-form-style-one">
                        <h5 class="sub-title">Have Questions?</h5>
                        <h2 class="heading">Send us a Massage</h2>
                        <form action="{{ route('contact') }}" method="POST" class="contact-form contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control @error('name') is-invalid @enderror"
                                            data-error="Please enter your name" id="name" name="name"
                                            placeholder="Name *" type="text" value="{{ old('name') }}">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control @error('subject') is-invalid @enderror"
                                            data-error="Please enter your Subject" id="subject" name="subject"
                                            placeholder="Subject *" type="text" value="{{ old('subject') }}">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control @error('email') is-invalid @enderror"
                                            data-error="Please enter your email" id="email" name="email"
                                            placeholder="Email*" type="email" value="{{ old('email') }}">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control @error('phone') is-invalid @enderror"
                                            data-error="Please enter your phone" id="phone" name="phone"
                                            placeholder="Phone *" type="text" value="{{ old('phone') }}">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group comments">
                                        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment"
                                            placeholder="How Can We Assist You? *">
                                            {{ old('comment') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" name="submit" id="submit">
                                        <i class="fa fa-paper-plane"></i> Get in Touch
                                    </button>
                                </div>
                            </div>
                            <!-- Alert Message -->
                            <div class="col-lg-12 alert-notification">
                                <div id="message" class="alert-msg"></div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Contact -->

    <!-- Start Map 
    ============================================= -->
    <div class="maps-area bg-gray overflow-hidden">
        <div class="google-maps">
            <iframe src="{{App()->communication->localization ?? ''}}" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <!-- End Map -->
@endsection

