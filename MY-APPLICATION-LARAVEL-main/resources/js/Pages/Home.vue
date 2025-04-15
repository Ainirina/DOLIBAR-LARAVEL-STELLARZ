<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import CardComponent from '@/Components/CardComponent.vue'; // Importez le composant

const props = defineProps({
    products: Array,
    userLikes: Array,
    userCarts: Array
});

const likedProducts = ref(new Set(props.userLikes));
const cartProducts = ref(new Set(props.userCarts));
const searchQuery = ref('');
const selectedProduct = ref(null);
const visible = ref(false);

const filteredProducts = computed(() => {
    return props.products.filter(product =>
        product.label.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const toggleLike = (productId) => {
    router.post('/like', { product_id: productId }, {
        preserveScroll: true,
        onSuccess: () => {
            if (likedProducts.value.has(productId)) {
                likedProducts.value.delete(productId);
            } else {
                likedProducts.value.add(productId);
            }
        },
        onError: (error) => {
            console.error('Erreur lors du like', error);
        }
    });
};

const addToCart = (productId) => {
    router.post('/cart', { product_id: productId }, {
        preserveScroll: true,
        onSuccess: () => {
            if (cartProducts.value.has(productId)) {
                cartProducts.value.delete(productId);
            } else {
                cartProducts.value.add(productId);
            }
        },
        onError: (error) => {
            console.error('Erreur lors de ajout au panier', error);
        }
    });
};

const openDetails = (product) => {
    selectedProduct.value = product;
    visible.value = true;
};
</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <div class="py-12">


            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">


                <div class=" flex text-[--White] border-none focus:border-none focus:ring-0 backdrop-blur-sm bg-[--Black]">
                    <IconField class="w-full  ">
                        <InputIcon class="pi pi-search  " />
                        <InputText
                            class="w-full max-h-96 placeholder-[--White] text-[--White] border-none focus:border-none focus:ring-1"
                            v-model="searchQuery"
                            placeholder="Search"
                            :style="{ maxHeight: '50px', overflow: 'hidden' , backgroundColor: '#0D0D0D',borderRadius: '0.375rem',color: '#F4F4F4'}"
                        />
                    </IconField>
                </div>
                <br>
                <br>


                <div class=" ml-10 bg-[--Black] overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                    <div class="flex flex-wrap gap-4">
                        <CardComponent
                            v-for="product in filteredProducts"
                            :key="product.id"
                            :product="product"
                            :likedProducts="likedProducts"
                            :cartProducts="cartProducts"
                            @toggleLike="toggleLike"
                            @addToCart="addToCart"
                            @openDetails="openDetails"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
