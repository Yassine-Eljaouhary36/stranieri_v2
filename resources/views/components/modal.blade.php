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
                <button type="button" class="btn-custom btn-custom-secondary" data-bs-dismiss="modal">Close</button>

                <button id="card-button" class="btn-custom btn-custom-success " type="submit">
                    Pay 
                    <i class="ml-1 fa-solid fa-money-bill-wave"></i>
                </button>
            </div>
        </div>
    </div>
</div>
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
                // Swal.fire({
                //     title: "Error",
                //     text: "there is something wrong",
                //     icon: 'wrong',
                //     confirmButtonText: 'try again'
                // });
                // console.log(error)
            } else {

                // console.log(paymentMethod)

                const paymentMethodElement = document.querySelector('.payment-method');
                const cardForm = document.querySelector('.card-form');
                paymentMethodElement.value = paymentMethod.id;

                cardForm.submit();
            }
        });
    </script>

@endpush