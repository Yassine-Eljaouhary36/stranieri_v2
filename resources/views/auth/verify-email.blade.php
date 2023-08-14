@extends('layouts.app')
@section('content')
<section >
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
                <div class="alert alert-secondary container mt-4">
                    <p>
                        Thanks for signing up! Before getting started, 
                    </p>
    
                    <p>
                      could you verify your email address by clicking on the link we just emailed to you?
                      If you didn't receive the email, we will gladly send you another.
                    </p>
                     
                     <div class="mt-4 d-flex align-items-center justify-content-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
            
                            <div>
                                <button
                                class="btn btn-dark"
                                type="submit"
                                >
                                    {{ __('Resend Verification Email') }}
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