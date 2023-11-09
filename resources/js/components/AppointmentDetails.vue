<template>

    <div class="cart-item"  >
        
        <table class="styled-table" >
            <thead>
                <tr>
                    <th class="text-center">{{titletime}} </th>
                    <th class="text-center">{{titledate}} </th>
                    <th class="text-center">{{titleprice}}</th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in cart" :key="item">       
                    <td  class="text-center">
                        <div  
                            :class="{'item-day':true ,'rlt':local=='ar' }"  
                            > <span style="padding: 0px 5px;">{{formatDateToGetDay(item) }} </span> <span>{{ formatDateToCustomFormat(item) }}</span> 
                        </div>
                    </td>  
                    <td class="text-center">
                        <div class="item-time">{{ formatTimeToCustomFormat(item) }}</div>
                    </td>
                    <td class="text-center">
                        <span class="item-price">{{ formatPrice(price) }}</span>
                    </td>
                    <td class="text-center">
                        <i class="fas fa-trash text-danger" style="cursor: pointer;" @click="clearCart"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
  
</template>
  
<script>
 export default {  
    props: {
        price:Number,
        local:String,
        titleprice:String,
        titledate:String,
        titletime:String
    },
    data() {
        return {
            cart: [],
        };
    }, 
    methods: {
        clearCart(){
            document.cookie = "cart=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            window.location.href = '/customer/meetings-panel'
        },
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


.styled-table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}
.styled-table th, .styled-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
}

.styled-table th {
    background-color: #f0f0f0;
    font-weight: bold;
}
.styled-table tbody tr:hover {
    background-color: #e0e0e0;
}

.cart-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 15px;  
    border-radius: 10px;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
    background-color: #fcfcfd;
    border: 1px solid #ccc;
    border-radius: 10px;
    margin: 0px 10px;
    /* overflow-x: auto; */
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
    display: flex;
    justify-content: center;
}
.item-price {
    font-weight: bold;
    color: #76c6ff; 
    padding: 5px;
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
  