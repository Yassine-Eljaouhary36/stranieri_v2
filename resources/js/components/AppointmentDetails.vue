<template>

    <div class="cart-items">
        <!-- Sample Cart Item -->
        <div 
            :class="{'cart-item':true ,'rlt':local=='ar' }"  
            v-for="item in cart" :key="item">

            <div class="item-details" >
                <div class="item-description"> {{transilation()}} </div>
            </div>
            <div class="item-date-time">
                <div class="item-date">
                    <div v-if="local!='ar'" class="item-day">{{formatDateToGetDay(item)}}</div>
                    <div>{{formatDateToCustomFormat(item)}}</div>
                    <div v-if="local=='ar'" class="item-day">{{formatDateToGetDay(item)}}</div>
                </div>
            </div>
            <div class="item-date-time">
                <div class="item-time">{{ formatTimeToCustomFormat(item) }}</div>
            </div>
            <div class="item-price">{{ formatPrice(price) }}</div>
        </div>
    </div>
  
</template>
  
<script>
 export default {  
    props: {
        price:Number,
        local:String,
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
        formatDateToCustomFormat(isoString) {
            const date = new Date(isoString);
            const options = {  month: 'long' };
            switch (this.local) {
                    case 'al':
                        var months = ["Janar", "Shkurt", "Mars", "Prill", "Maj", "Qershor", "Korrik", "Gusht", "Shtator", "Tetor", "Nëntor", "Dhjetor"];
                        return months[date.getMonth()]+ " " + date.getFullYear();
                    case 'ar':
                        return date.toLocaleDateString('ar-EG', { month: 'long'})+ " " + date.getFullYear();
                    case 'it':
                        return date.toLocaleDateString('it-IT', options)+ " " + date.getFullYear();
                    default:
                        return date.toLocaleDateString('en-US', options)+ " " + date.getFullYear();
                }
        },
        formatDateToGetDay(isoString) {
            const date = new Date(isoString);
            
            return date.getDate();
        },
        formatTimeToCustomFormat(isoString) {
            const date = new Date(isoString);
            const options = { hour: '2-digit', minute: '2-digit', hour12: false };
            return date.toLocaleTimeString('en-US', options);
        },
        formatPrice(price){
            return '$'+price.toFixed(2)
        },
        transilation(){
            switch (this.local) {
                case 'al':
                    return 'Rezervoni një takim'
                case 'ar':
                    return 'حجز اجتماع'  
                case 'it':
                    return 'Prenota un incontro'
                default:
                    return 'Book a meeting '  
                }
        }
        
    },       
    created() {
        const cartData = this.getCookie('cart');
        if (cartData) {
            this.cart = JSON.parse(cartData);
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

.rlt{
    flex-direction: row-reverse; 
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
.item-date {
    display: flex;
}
.item-day{
    padding: 0px 5px;
}
.item-price {
    font-weight: bold;
    color: #76c6ff; 
    padding: 5px 10px;
    border: 2px solid #76c6ff;
    border-radius: 10px;
}





@media screen and (max-width: 650px) {

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


</style>
  