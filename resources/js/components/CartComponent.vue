<template>
    <div class="cart-container">
        <div class="cart-header">
            <h1>My Meetings Cart</h1>
        </div>
        <div class="cart-items">
            <!-- Sample Cart Item -->
            <div class="cart-item">
                <div class="item-details">
                    <div class="item-description">Meeting </div>
                    <div class="item-date-time">
                        <div class="item-date">4 August 2023</div>
                        <div class="item-time">16:00</div>
                    </div>
                </div>
                <div class="item-price">$50.00</div>
                <button class="remove-button"><i class="fa-solid fa-trash"></i></button>
            </div>
            <div class="cart-item">
                <div class="item-details">
                    <div class="item-description">Meeting </div>
                    <div class="item-date-time">
                        <div class="item-date">4 August 2023</div>
                        <div class="item-time">16:00</div>
                    </div>
                </div>
                <div class="item-price">$50.00</div>
                <button class="remove-button"><i class="fa-solid fa-trash"></i></button>
            </div>
            <!-- Add more cart items here -->
        </div>
        <div class="cart-total">
            <div class="subtotal">
              <div class="subtotal-title">Subtotal</div>
              <div class="subtotal-value"> $50.00</div>
            </div>
            <div class="discount">
              <div class="discount-title">Discount</div>
              <div class="discount-value"> -$10.00</div>
            </div>
            <div class="discount">
              <div class="total-title">Total</div>
              <div class="total-value"> $40.00</div>
            </div>
       </div>
        <div class="more-infos">
            <div class="promo-section">
                <input type="text" class="promo-input" placeholder="Enter Promo Code">
                <button class="apply-button">Apply Discount</button>
            </div>
            <div class="checkout-buttons">
                <button class="checkout-button">Checkout</button>
                <button class="continue-shopping-button">Continue Shopping</button>
            </div>
        </div>
    </div>
</template>
  
<script>
 export default {  
    data() {
        return {
            cart: [],
        };
    }, 
    methods: {
        getCookie(name) {
            const cookies = document.cookie.split('; ');
            for (const cookie of cookies) {
                const [cookieName, cookieValue] = cookie.split('=');
                if (cookieName === name) {
                return decodeURIComponent(cookieValue);
                }
            }
            return null;
        },
    },       
    created() {
        const cartData = this.getCookie('cart');
        console.log(cartData)
        if (cartData) {
            this.cart = JSON.parse(cartData);
        }
    },
};
</script>
    
  <style scoped>
 /* Reset some default browser styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Cart Container */
.cart-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 20px;
    background-color: #f2f5f7;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}
h1{
    color: #777;
}
.cart-header {
    text-align: center;
    margin-bottom: 20px;
    
}

/* Cart Items */
.cart-items{
    padding: 10px 20px 25px 20px;
}
.cart-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px 2px;  
    border-bottom: 2px solid #e5e5e5;
}

.item-details {
    /* flex: 1; */
    padding-right: 20px;
}

.item-description {
    font-weight: bold;
    color: #333;
}

.item-date-time {
    color: #777;
}

.item-price {
    font-weight: bold;
    color: #828282; /* Green color for positive price */
    padding:0px 10px
}

.remove-button {

    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
    background-color: #ffffff;
    color: #e74c3c;
    border: 2px solid #e74c3c;
}

.remove-button:hover {
    transform: scale(1.05); /* Slight scale-up on hover */
    background-color: #c0392b;
    color: #ffffff;
    border: 2px solid #c0392b;
}
.more-infos{
    display: flex;
    margin-top:10px;
  justify-content: space-between;
    padding:20px 0px 0px 0px;
}
/* Promo Section */
.promo-section {
    width:70%;
}

.promo-input {
    width: 70%;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 4px 0px 0px 4px;
}

.apply-button {
    background-color: #001742;
    color: #fff;
    border: none;
    border-radius: 0px 4px 4px 0px;
    padding: 15px 12px;
    cursor: pointer;
}
.apply-button:hover {
    background-color: #2980b9;
}
/* Cart Total */
.cart-total {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;

}
.subtotal,
.discount,
.total {
    flex-basis: 100%; /* Full width by default */
    margin-bottom: 10px;
    border: 2px solid #dfdfdf;
    border-radius: 3px; 
    padding: 20px 30px;
    margin: 10px 0px;
    display: flex;
    color:#777;
    justify-content: center;
    align-items: center;
   flex-direction: column;
}
.subtotal-value,
.discount-value,
.total-value {
   font-weight: bold;
}

/* Checkout Buttons */
.checkout-buttons {
    text-align: center;
    display: flex;
    align-items: center;
  flex-direction: column;
  width:25%
}

.checkout-button, .continue-shopping-button {
    background-color: #001742;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 15px 12px;
    margin: 5px 0px;
    cursor: pointer;
    width:100%
}

.checkout-button:hover, .continue-shopping-button:hover {
    background-color: #2980b9;
}

@media screen and (min-width: 576px) {
    .subtotal,
    .discount,
    .total {
        flex-basis: calc(50% - 10px); /* Divide into 2 equal columns with spacing */
        margin-bottom: 0;
    }
}

@media screen and (max-width: 650px) {
      .promo-section {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-top: 20px;
        width: 100%;
    }
     .promo-input,
    .apply-button {
        width: 100%;
        margin-bottom: 10px;
        border-radius: 0px;
    }
     .more-infos {
        flex-direction: column;
        margin-top:0px;
    }
     .cart-total {
        text-align: left;
        margin-top: 20px;
    }
    .checkout-buttons {
      margin-top:5px;
      width: 100%;
      align-items: end;
    }
  .checkout-button, .continue-shopping-button {
    width:40%
  }
}
@media screen and (min-width: 768px) {
    .subtotal,
    .discount,
    .total {
        flex-basis: calc(33.33% - 10px); /* Divide into 3 equal columns with spacing */
        margin-bottom: 0;
    }
}
/* Responsive Styles */
@media screen and (max-width: 480px) {
    .cart-container {
        padding: 10px;
    }

    .cart-item {
        flex-direction: column;
    }

    .item-details {
        padding-right: 0;
        margin-bottom: 10px;
    }

    .remove-button {
        margin-top: 10px;
    }
  
    .checkout-buttons {
        text-align: left;
        margin-top: 20px;
    }

    .checkout-button,
    .continue-shopping-button {
        width: 100%;
        margin: 5px 0;
    }
}

  </style>
  