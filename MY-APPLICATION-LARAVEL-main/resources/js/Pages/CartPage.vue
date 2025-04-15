<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, defineProps, computed } from 'vue';

// Props venant du contrôleur
const props = defineProps({
  cartProducts: Array,
});

// Réactivité
const cartProducts = ref([...props.cartProducts]);
const successMessage = ref('');

// Calcul du total du panier
const cartTotal = computed(() => {
  return cartProducts.value
    .reduce((sum, p) => sum + (parseFloat(p.price) * p.quantity), 0);
});

const addCart = (productId) => {
    router.post('/cart', { product_id: productId }, {
        preserveScroll: true,
        onSuccess: () => {
            cartProducts.value = cartProducts.value.filter(p => p.id !== productId);
        },
        onError: (error) => {
            console.error('Erreur lors de l’ajout au panier', error);
        }
    });
};

// Mettre à jour la quantité
const updateQuantity = (productId, quantity) => {
    router.post('/cart/update-quantity', { product_id: productId, quantity }, {
        preserveScroll: true,
        onSuccess: () => {
            const product = cartProducts.value.find(p => p.id === productId);
            if (product) {
                product.quantity = quantity;
            }
        },
        onError: (error) => {
            console.error('Erreur lors de la mise à jour de la quantité', error);
        },
    });
};


const validateOrder = () => {
    router.post('/cart/order', { cartProducts: cartProducts.id }, {
        preserveScroll: true,
        onSuccess: (response) => {
            successMessage.value = 'Commande validée avec succès!';
            cartProducts.value = []; // Optionnel : vider le panier
        },
        onError: (error) => {
            console.error('Erreur lors de la validation de la commande', error);
        }
    });
};

// Formatage du prix
const formatPrice = (price) => {
  // parseFloat pour être sûr d’avoir un nombre
  const num = typeof price === 'string' ? parseFloat(price) : price;
  return num.toFixed(2);
};
</script>

<template>
  <Head title="Mon Panier" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl leading-tight">Mon Panier</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

          <!-- Si panier non vide -->
          <div v-if="cartProducts.length">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Produit
                  </th>
                  <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Prix unitaire
                  </th>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Quantité
                  </th>
                  <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Sous‑total
                  </th>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="product in cartProducts" :key="product.id">
                  <!-- Nom + modèle (et image si dispo) -->
                  <td class="px-6 py-4 flex items-center">
                    <img
                      v-if="product.image"
                      :src="product.image"
                      alt=""
                      class="w-16 h-16 object-cover rounded mr-4"
                    />
                    <div>
                      <div class="text-sm font-medium text-gray-900">{{ product.name }}</div>
                      <div class="text-sm text-gray-500">{{ product.model }}</div>
                    </div>
                  </td>
                  <!-- Prix unitaire -->
                  <td class="px-6 py-4 text-right text-sm text-gray-900">
                    {{ formatPrice(product.price) }}€
                  </td>
                  <!-- Quantité -->
                  <td class="px-6 py-4 text-center">
                    <input
                      type="number"
                      v-model.number="product.quantity"
                      min="1"
                      class="w-16 px-2 py-1 border rounded text-center"
                      @change="updateQuantity(product.id, product.quantity)"
                    />
                  </td>
                  <!-- Sous‑total -->
                  <td class="px-6 py-4 text-right text-sm text-gray-900">
                    {{ formatPrice(product.price * product.quantity) }}€
                  </td>
                  <!-- Supprimer -->
                  <td class="px-6 py-4 text-center">
                    <Button
                      icon="pi pi-trash"
                      variant="text"
                      class="text-red-500 hover:bg-red-50"
                      @click="addCart(product.id)"
                    />
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- Message de succès -->
            <div v-if="successMessage" class="mt-4 p-4 bg-green-100 text-green-800 rounded">
              {{ successMessage }}
            </div>

            <!-- Total + bouton valider -->
            <div class="mt-6 flex justify-end items-center space-x-4">
              <div class="text-lg font-semibold">
                Total : {{ formatPrice(cartTotal) }}€
              </div>
              <Button
                label="Valider la commande"
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                @click="validateOrder"
              />
            </div>
          </div>

          <!-- Panier vide -->
          <p v-else class="text-gray-500">Votre panier est vide pour le moment.</p>

        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
