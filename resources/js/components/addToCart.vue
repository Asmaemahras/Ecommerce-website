<template>
    <div class="flex items-center justify-between py-4">
        <button class="bg-violet-600 text-white p-2 rounded-full"
        v-on:click.prevent="addToCart"
        >
        Ajouter au panier</button>
    </div>
</template>


<script setup>
import useProduct from '../composables/products';
import { inject } from 'vue';
    const emitter = require('tiny-emitter/instance');
    const toast = inject('toast');


    const { add } = useProduct();
    const productId = defineProps(['productId']);
    const addToCart = async() => {
        await axios.get('/sanctum/csrf-cookie');
        await axios.get('/api/user')
            .then(async(res) => {
               let cartCount = await add(productId); //ajouter un produit à mon panier 
               emitter.emit('cartCountUpdated', cartCount);
               toast.success('Produit ajouté !');
            })
            .catch(() => {
                toast.error('Merci de vous connecter pour ajouter un produit');
            });
    }
</script> 
