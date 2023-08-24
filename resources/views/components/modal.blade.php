<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-custom btn-custom-secondary" data-bs-dismiss="modal"> {{ __('Close') }}</button>
                @auth('client')
                    @if ($client->billingAddress)
                        <button id="card-button" class="btn-custom btn-custom-success " type="submit">
                            <span id="text-pay" >
                                {{ __('Pay') }}
                                <i class="ml-1 fa-solid fa-money-bill-wave"></i>
                            </span>
                            <span id="text-loading" class="d-none">
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                <span class="ml-1" role="status">Loading...</span>
                            </span>
                        </button>
                    @else
                    <button id="address-button" class="btn-custom btn-custom-success " type="submit">
                        {{ __('Submit') }}
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@auth('client')
    @if ($client->billingAddress)
        @push('scripts')

            <script src="https://js.stripe.com/v3/"></script>
    
            <script>
                const stripe = Stripe("{{ env('STRIPE_KEY') }}");
                let style = {
                        base: {
                            color: '#32325d',
                            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                            fontSmoothing: 'antialiased',
                            fontSize: '16px',
                            '::placeholder': {
                                color: '#aab7c4'
                            },
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                        }
                    }
                const elements = stripe.elements();
                const cardElement = elements.create('card', {style: style});
            
                cardElement.mount('#card-element');


                const cardHolderName = document.getElementById('card-holder-name');
                const cardButton = document.getElementById('card-button');
                
                    
                var textPay = document.getElementById('text-pay');
                var textLoading = document.getElementById('text-loading');

                cardButton.addEventListener('click', async (e) => {
                    e.preventDefault();

                    const messageError = document.getElementById('error-message');
                    if (cardHolderName.value.trim() === '') {
                        cardHolderName.classList.add('is-invalid');
                        messageError.textContent = 'card holder name is required.';
                        return true
                    }else {
                        cardHolderName.classList.remove('is-invalid');
                        messageError.textContent = '';
                    }

                    const { paymentMethod, error } = await stripe.createPaymentMethod(
                        'card', cardElement, {
                            billing_details: { name: cardHolderName.value }
                        }
                    );
        

                    if (error) {
                        Swal.fire({
                            title: "Error",
                            text: "there is something wrong",
                            icon: 'wrong',
                            confirmButtonText: 'try again'
                        });
                        // Remove the 'disabled' attribute from the card button
                        cardButton.removeAttribute('disabled');
            
                        textLoading.classList.add('d-none');
                        textPay.classList.remove('d-none');

                        // console.log(error)
                    } else {

                        // console.log(paymentMethod)

                        const paymentMethodElement = document.querySelector('.payment-method');
                        const cardForm = document.querySelector('.card-form');
                        paymentMethodElement.value = paymentMethod.id;

                        cardForm.submit();
                        // Set the 'disabled' attribute to true for the card button
                        cardButton.setAttribute('disabled', true);
                    
                        textPay.classList.add('d-none');
                        textLoading.classList.remove('d-none');
                    }
                });
            </script>

        @endpush
    @else
    @push('scripts')
        <script>
            const addressButton = document.getElementById('address-button');

            var address_one = document.getElementById('address_one');
            var country = document.getElementById('country');
            var city = document.getElementById('city');
            var zip = document.getElementById('zip');
            addressButton.addEventListener('click', async (e) => {
                const addressForm = document.querySelector('.address-form');

                if (country.value === '') {
                    country.classList.add('is-invalid');
                    return true
                }else {
                    country.classList.remove('is-invalid');
                }

                if (address_one.value === '') {
                    address_one.classList.add('is-invalid');
                    return true
                }else {
                    address_one.classList.remove('is-invalid');
                }

                if (city.value === '') {
                    city.classList.add('is-invalid');
                    return true
                }else {
                    city.classList.remove('is-invalid');
                }

                if (zip.value === '') {
                    zip.classList.add('is-invalid');
                    return true
                }else {
                    zip.classList.remove('is-invalid');
                }
                addressForm.submit();
            });
        </script>
    @endpush
    @endif
@endauth