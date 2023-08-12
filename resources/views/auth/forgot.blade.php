@extends('layouts.app')
@section('content')
<section >
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-3 pb-2 pb-md-0 mb-md-4">Forgot password</h3>
                <form  method="POST" action="{{route('sendResetLink')}}" id="Form">
                    @csrf
                    <div class="col">
                        <p class="text-primary">
                            Enter your email address and we will send you a link to reset your password
                        </p>
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="email">Email Address</label>
                        <input value="{{ old('email') }}"  type="email" name="email"  id="email" class="@error('email') is-invalid @enderror form-control form-control-lg" />
                        <div class="invalid-feedback"> {{ $errors->first('email') ?? '' }}</div>
                    </div>
                  
                    
                  
                    <!-- Submit button -->
                    <div  class="d-grid gap-2 col-6 mx-auto mb-4">
                        <button type="submit" class="btn btn-primary btn-lg"> Send Reset Password Link</button>
                    </div>
                    
                  
                    <!-- Register buttons -->
                    <div class="text-center">
                      <p>Already have an account? <a href="{{ route('showLoginForm') }}">Login</a></p>
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
                    { id: "email", message: "Email is required" },
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