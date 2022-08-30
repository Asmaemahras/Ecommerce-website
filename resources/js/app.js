import './bootstrap';


import Alpine from 'alpinejs';

import { createApp } from 'vue';

import AddToCart from './components/addToCart.vue';
import NavbarCart from './components/NavbarCart.vue';
import Toaster from "@meforma/vue-toaster";
import ShoppingCart from './components/ShoppingCart.vue';
import StripeCheckout from './components/StripeCheckout.vue';


window.Alpine = Alpine;

Alpine.start();

const app = createApp();
app.use(Toaster).provide('toast', app.config.globalProperties.$toast);

app.component('addToCart', AddToCart);
    
app.component('StripeCheckout', StripeCheckout);
app.component('NavbarCart', NavbarCart);
app.component('ShoppingCart', ShoppingCart);
app.mount('#app');