@extends('layouts.app')
@section('content')
<x-breadcrumb globalTitle="{{ __('register_login.Create_Account') }}" secondTitle="{{ __('register_login.Create_Account') }}" />
<section >
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px; {{ app()->getLocale() == 'ar' ? "direction: rtl;" : "" }}">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-3 pb-2 pb-md-0 mb-md-4">{{ __('register_login.Create_Account') }}</h3>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif
              <form method="POST" action="{{route('register')}}" id="registrationForm">
                 @csrf
  
                <div class="row">
                  <div class="col-md-6 mb-4">
  
                    <div class="form-outline">
                        <label class="form-label" for="first_name">{{ __('register_login.First_Name') }}</label>
                        <input value="{{ old('first_name') }}"  type="text" name="first_name"  id="first_name" class="@error('first_name') is-invalid @enderror form-control form-control-lg" />
                        <div class="invalid-feedback"> {{ $errors->first('first_name') ?? '' }}</div>
                    </div>
  
                  </div>
                  <div class="col-md-6 mb-4">
  
                    <div class="form-outline">
                        <label class="form-label" for="last_name">{{ __('register_login.Last_Name') }}</label>
                        <input value="{{ old('last_name') }}"  type="text" name="last_name" id="last_name" class="@error('last_name') is-invalid @enderror form-control form-control-lg" />
                        <div class="invalid-feedback"> {{ $errors->first('last_name') ?? '' }}</div>
                    </div>
                    
                  </div>
                  
                </div>
  
                <div class="row">
                    <div class="col-md-6 mb-4">
    
                      <div class="form-outline">
                          <label class="form-label" for="email">{{ __('register_login.Email_Address') }}</label>
                          <input value="{{ old('email') }}"  type="email" name="email"  id="email" class="@error('email') is-invalid @enderror form-control form-control-lg" />
                          <div class="invalid-feedback"> {{ $errors->first('email') ?? '' }}</div>
                      </div>
    
                    </div>
                    <div class="col-md-6 mb-4">
    
                      <div class="form-outline">
                          <label class="form-label" for="phone">{{ __('register_login.Phone') }}</label>
                          <input value="{{ old('phone') }}"  type="text" name="phone" id="phone" class="@error('phone') is-invalid @enderror form-control form-control-lg" />
                          <div class="invalid-feedback"> {{ $errors->first('phone') ?? '' }}</div>
                      </div>
    
                    </div>
                    
                  </div>
  
                <div class="row">
                    <div class="col-md-6 mb-4">
    
                        <div class="form-outline">
                            <label class="form-label" for="password">{{ __('register_login.Password') }}</label>
                            <input value="{{ old('password') }}"  type="password" name="password" id="password" class="@error('password') is-invalid @enderror form-control form-control-lg" />
                            <div class="invalid-feedback"> {{ $errors->first('password') ?? '' }}</div>
                        </div>
      
                      </div>
                      <div class="col-md-6 mb-4">
    
                        <div class="form-outline">
                            <label class="form-label" for="password_confirmation">{{ __('register_login.Confirm_Password') }}</label>
                            <input value="{{ old('password_confirmation') }}"  type="password" name="password_confirmation" id="password_confirmation" class="@error('password_confirmation') is-invalid @enderror form-control form-control-lg" />
                            <div class="invalid-feedback"> {{ $errors->first('password_confirmation') ?? '' }}</div>
                        </div>
      
                      </div>
                </div>

                <div class="row">
                    <div class="col mt-1 mb-2" style="display: flex; align-items: center">
                      {{-- <div class="form-check text-start my-1"> --}}
                        <input class=" mx-1" type="checkbox" id="flexCheckDefault" name="agree" required>
                        <label class="pt-1" for="flexCheckDefault">
                          {{ __('register_login.Confirm_Agree') }} <a href="{{ route('privacy.policy') }}" target="_blank">{{ __('register_login.Terms_Conditions') }}</a>
                        </label>
                      {{-- </div> --}}
                    </div>
                </div>

            
                <div  class="d-grid gap-2 col-6 mx-auto my-1">
                  <button type="submit" class="custom-button">{{ __('register_login.register') }}</button>
                </div>
  
                <div class="row">
                  <div class="col my-1">
                    <div class="d-flex justify-content-center">
                        <span class="px-1">{{__('register_login.Already_Account')}}</span> 
                        <a style="text-decoration: underline;" class="text-primary" href="{{ route('showLoginForm') }}"> {{ __('register_login.Login') }} </a>
                    </div>
                  </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("registrationForm");
    
            form.addEventListener("submit", function (event) {
                event.preventDefault();
    
                if (validateForm()) {
                    form.submit();
                }
            });
    
            function validateForm() {
                const fields = [
                    { id: "first_name", message: "{{__('validation.required', ['attribute' => __('register_login.First_Name')])}}" },
                    { id: "last_name", message: "{{__('validation.required', ['attribute' => __('register_login.Last_Name')])}}" },
                    { id: "email", message: "{{__('validation.required', ['attribute' => __('register_login.Email_Address')])}}" },
                    { id: "password", message: "{{__('validation.required', ['attribute' => __('register_login.Password')])}}" },
                    { id: "password_confirmation", message: "{{__('validation.required', ['attribute' => __('register_login.Confirm_Password')])}}" }
                ];
    
                clearErrorMessages();
    
                let isValid = true;
    
                fields.forEach(field => {
                    const input = document.getElementById(field.id);
                    if (!input.value.trim()) {
                        displayErrorMessage(input, field.message);
                        isValid = false;
                    }
                });
    
                return isValid;
            }
    
            function displayErrorMessage(inputElement, message) {
                const errorMessage = inputElement.parentNode.querySelector(".invalid-feedback");
                errorMessage.textContent = message;
    
                inputElement.classList.add("is-invalid");
                errorMessage.style.display = "block";
            }
    
            function clearErrorMessages() {
                const inputFields = form.getElementsByClassName("form-control");
                Array.from(inputFields).forEach(inputField => {
                    inputField.classList.remove("is-invalid");
                    const errorMessage = inputField.parentNode.querySelector(".invalid-feedback");
                    errorMessage.textContent = "";
                    errorMessage.style.display = "none";
                });
            }
        });
    </script>
    
@endpush