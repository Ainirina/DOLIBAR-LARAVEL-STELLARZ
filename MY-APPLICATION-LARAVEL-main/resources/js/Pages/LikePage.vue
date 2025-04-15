<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';

// Props venant du contrôleur
const props = defineProps({
    likedProducts: Array,
    products: Array,
    userCarts: Array
});

// Convertir les produits en un tableau réactif
const likedProducts = ref([...props.likedProducts]);
const cartProducts = ref(new Set(props.userCarts));
// Fonction pour liker/unliker un produit
const toggleLike = (productId) => {
    router.post('/like', { product_id: productId }, {
        preserveScroll: true,
        onSuccess: () => {
            // Vérifier si le produit est déjà liké
            const index = likedProducts.value.findIndex(p => p.id === productId);
            if (index !== -1) {
                // Si liké, on l'enlève
                likedProducts.value.splice(index, 1);
            } else {
                // Sinon, on l'ajoute (optionnel, selon ce que tu veux afficher)
                likedProducts.value.push({ id: productId });
            }
        },
        onError: (error) => {
            console.error('Erreur lors du like', error);
        }
    });
};
const addCart = (productId) => {
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
            console.error('Erreur lors du ajout au panier', error);
        }
    });
};
</script>

<template>
    <Head title="Liked Products" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Liked Products</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold">Produits Likés</h3>

                        <ul v-if="likedProducts.length">
                            <li v-for="product in likedProducts" :key="product.id">
                                <strong>{{ product.name }}</strong> - {{ product.price }}€ (Modèle: {{ product.model }})
                                <button @click="addCart(product.id)" class="ml-2 p-1 border rounded">
                                {{ cartProducts.has(product.id) ? 'Remove' : 'Add to cart' }}
                            </button>
                                <button @click="toggleLike(product.id)" class="ml-2 text-red-500">
                                    Unlike
                                </button>

                            </li>
                        </ul>
                        <p v-else class="text-gray-500">Aucun produit liké pour le moment.</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
