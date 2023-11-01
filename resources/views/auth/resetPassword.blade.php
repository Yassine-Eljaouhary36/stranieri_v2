@extends('layouts.app')
@section('content')
<x-breadcrumb globalTitle="{{__('register_login.Reset_Password')}}" secondTitle="{{__('register_login.Reset_Password')}}" />
<section >
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;{{ app()->getLocale() == 'ar' ? "direction: rtl;" : "" }}">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-3 pb-2 pb-md-0 mb-md-4">{{__('register_login.Reset_Password')}}</h3>
                <form  method="POST" action="{{route('resePassword')}}" id="Form">
                    @csrf
                    <div class="row">
                          <input  value="{{ $token ?? '' }}"  type="hidden" name="token">
                    </div>
                  
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">{{__('register_login.Password')}}</label>
                        <input value="{{ old('password') }}"  type="password" name="password" id="password" class="@error('password') is-invalid @enderror form-control form-control-lg" />
                        <div class="invalid-feedback"> {{ $errors->first('password') ?? '' }}</div>
                    </div>
                  
                    <div class="form-outline mb-4">
                        <label class="form-label" for="password_confirmation">{{__('register_login.Confirm_Password')}}</label>
                        <input value="{{ old('password_confirmation') }}"  type="password" name="password_confirmation" id="password_confirmation" class="@error('password_confirmation') is-invalid @enderror form-control form-control-lg" />
                        <div class="invalid-feedback"> {{ $errors->first('password_confirmation') ?? '' }}</div>
                    </div>

                  
                    <!-- Submit button -->
                    <div  class="d-grid gap-2 col-6 mx-auto mb-4">
                        <button type="submit" class="custom-button">{{__('register_login.Reset_Password')}}</button>
                    </div>
                    
                  
                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>{{__('register_login.Already_Account')}} <a href="{{ route('showLoginForm') }}">{{__('register_login.Login')}}</a></p>
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
            const form = document.getElementById("Form");
    
            form.addEventListener("submit", function (event) {
                event.preventDefault();
    
                if (validateForm()) {
                    form.submit();
                }
            });
    
            function validateForm() {
                const fields = [
                    { id: "password", message: "{{__('validation.required', ['attribute' => __('register_login.Password')])}}" },
                    { id: "password_confirmation", message: "{{__('validation.required', ['attribute' => __('register_login.Confirm_Password')])}}" },
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