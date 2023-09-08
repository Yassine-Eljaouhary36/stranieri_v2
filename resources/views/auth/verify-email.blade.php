@extends('layouts.app')
@section('content')
<section >
    <div class="container py-5 h-100" style="{{ app()->getLocale() == 'ar' ? "direction: rtl;" : "" }}">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
                <div class="alert alert-secondary container mt-4">
                    <p> 
                        {{ __('register_login.Title_Verification_Email') }}
                    </p>
    
                    <p>
                      {{ __('register_login.Message_Verification_Email') }}
                    </p>
                     
                     <div class="mt-4 d-flex align-items-center justify-content-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
            
                            <div>
                                <button
                                class="btn btn-dark"
                                type="submit"
                                >
                                    {{ __('register_login.Resend_Verification_Email') }}
                                </button>
                            </div>
                        </form>
                    </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection