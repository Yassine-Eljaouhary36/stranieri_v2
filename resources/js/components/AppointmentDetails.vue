<template>

        <div class="cart-header">
            <h1>My meeting appointment details</h1>
        </div>
        <div class="cart-items">
            <!-- Sample Cart Item -->
            <div class="cart-item"  v-for="item in cart" :key="item">
                <div class="item-details" >
                    <div class="item-description"> Book a meeting </div>
                </div>
                <div class="item-date-time">
                    <div class="item-date">{{formatDateToCustomFormat(item)}}</div>
                </div>
                <div class="item-date-time">
                    <div class="item-time">{{ formatTimeToCustomFormat(item) }}</div>
                </div>
                <div class="item-price">{{ formatPrice(price) }}</div>
            </div>
        </div>
        <div class="cart-total">
            <div class="subtotal">
              <div class="subtotal-title">Subtotal</div>
              <div class="subtotal-value"> {{formatPrice(subtotal)}}</div>
            </div>
            <div class="discount">
              <div class="discount-title">Discount</div>
              <div class="discount-value"> -{{ formatPrice(discounted) }}</div>
            </div>
            <div class="total">
              <div class="total-title">Total</div>
              <div class="total-value"> {{formatPrice(total)}}</div>
            </div>
       </div>
  
</template>
  
<script>
 export default {  
    props: {
        discount:Number,
        price:Number,
    },
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
        clearCartToCookie() {
            const expirationDate = new Date();
            expirationDate.setTime(expirationDate.getTime() + 10 * 60 * 1000); // Expires in 10 min
            document.cookie = `cart=${JSON.stringify([])};expires=${expirationDate.toUTCString()}`;
        },
        formatDateToCustomFormat(isoString) {
            const date = new Date(isoString);
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        },
        formatTimeToCustomFormat(isoString) {
            const date = new Date(isoString);
            const options = { hour: '2-digit', minute: '2-digit', hour12: false };
            return date.toLocaleTimeString('en-US', options);
        },
        formatPrice(price){
            return '$'+price.toFixed(2)
        }
        
    },       
    created() {
        const cartData = this.getCookie('cart');
        if (cartData) {
            this.cart = JSON.parse(cartData);
            this.clearCartToCookie()
        }
    },
    computed:{
        subtotal() {
            return this.cart.length*this.price
        },
        discounted(){
            return this.subtotal*this.discount/100
        },
        total() {
            return this.subtotal-this.discounted
        },
        isCouponValid() {
            return this.coupons.some(coupon => coupon.code === this.enteredCouponCode);
        },
    }
};
</script>
    
  <style scoped>
 /* Reset some default browser styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

h1{
    color: #91bee1;
    font-size: 25px;
}
.cart-header {
    text-align: center;
    margin: 8px 0px;
    
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
    color: #838383;
}

.item-date-time {
    color: #777;
}

.item-price {
    font-weight: bold;
    color: #76c6ff; 
    padding: 5px 10px;
    border: 2px solid #76c6ff;
    border-radius: 10px;
}

.more-infos{
    display: flex;
    margin-top:10px;
  justify-content: space-between;
    padding:20px 0px 0px 0px;
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
    /* border: 2px solid #dfdfdf; */
    border-radius: 10px; 
    padding: 20px 30px;
    margin: 10px 0px;
    display: flex;
    color:#777;
    justify-content: center;
    align-items: center;
   flex-direction: column;
}

.subtotal {
    border: 2px solid #6fb7ff;
    /* color: #76c6ff; */
}
.discount {
    border: 2px solid #ff9494;
    /* color: #ff9494; */
}
.total {
    border: 2px solid #96c879;
    /* color:#96c879; */
}
.subtotal-value,
.discount-value,
.total-value {
   font-weight: bold;
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
     .more-infos {
        flex-direction: column;
        margin-top:0px;
    }
     .cart-total {
        text-align: left;
        margin-top: 20px;
    }
    .cart-item {
        flex-direction: column;
    }
    .item-details {
        margin-bottom: 10px;
    }
    .item-date-time {
        margin-bottom: 10px;
    }

}
@media screen and (min-width: 768px) {
    .subtotal,
    .discount,
    .total {
        flex-basis: calc(33.33% - 10px); /* Divide into 3 equal columns with spacing */
        margin-bottom: 0;
    }
    .h1 {
        font-size: 16px;
    }
}

</style>
  