<script setup>
import { defineProps, defineEmits, computed, ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';


const props = defineProps({
    product: {
        type: Object,
        required: true,
        default: () => ({
            id: '',
            name: '',
            description: '',
            price: 0,
            image: ''
        })
    },
    likedProducts: {
        type: Set,
        required: true
    },
    cartProducts: {
        type: Set,
        required: true
    }
});

const emits = defineEmits(['toggleLike', 'addToCart']);

const isLiked = computed(() => props.likedProducts.has(props.product.id));
const isInCart = computed(() => props.cartProducts.has(props.product.id));

const toggleLike = () => {
    emits('toggleLike', props.product.id);
};

const addToCart = () => {
    emits('addToCart', props.product.id);
};
const formatPrice = (price) => {
  // parseFloat pour être sûr d’avoir un nombre
  const num = typeof price === 'string' ? parseFloat(price) : price;
  return num.toFixed(2);
};
// Gestion de la dialog
const visible = ref(false);
const openDetails = () => {
    visible.value = true;
};

const numberFormatter = new Intl.NumberFormat('fr-FR', {
  minimumFractionDigits: 2,
  maximumFractionDigits: 2,
});


// Mettre à jour la quantité
const updateNote = (productId, note) => {
    router.post('/home/update-Note', {
        product_id: productId,
        note: note
    }, {
        preserveScroll: true,
        onSuccess: () => {
            console.error('success lors de la mis a jour');
        },
        onError: (error) => {
            console.error('Erreur lors de la mise à jour de la quantité', error);
        },
    });
};
const getWeightValue = (unitCode) => {
  switch (unitCode) {
    case 0: // kg
      return `kg`;
    case -3: // g
      return `g`;
    case -6: // mg
      return `mg`;
    case 3: // t
      return `t`;
    case 1: // lb
      return `lb`;
    case 2: // oz
      return `oz`;
    case 4: // oz t
      return `oz t`;
    case 5: // st
      return `st`;
    case 6: // cwt
      return `cwt`;
    case 7: // long cwt
      return `long cwt`;
    case 8: // short cwt
      return `short cwt`;
    default:
      return `(unité inconnue)`;
  }
};

</script>

<template>
    <div>
        <!-- Card Component -->
        <Card class="w-72 h-full border  flex flex-col ![rounded-none]transition-all duration-300 hover:shadow-lg hover:scale-[1.02]" style="border-radius: 0 !important">
                                    <!-- Header avec image -->
            <template #header>
                <div class="relative h-48 overflow-hidden rounded-none bg-gray-50">
                    <img
                        src="/img/vtt.jpg"
                        :alt="product.label"
                        class="object-cover w-full h-full "
                    />
                    <!-- Bouton d'action -->
                    <div class="absolute top-2 right-2 flex gap-2">
                        <Button
                            icon="pi pi-arrow-up-right-and-arrow-down-left-from-center"
                            @click="openDetails"
                            class="!p-2 !w-10 !h-10 rounded-full bg-white/80 backdrop-blur-sm hover:bg-white"
                            text
                            severity="secondary"
                        />
                    </div>
                </div>
            </template>

            <!-- Contenu -->
            <template #content>
                <div class="flex flex-col gap-2 rounded-none">
                    <h3 class="text-lg font-semibold text-gray-900 line-clamp-1">{{ product.label }}</h3>
                    <p class="text-sm text-gray-500 line-clamp-2">{{ product.description }}</p>
                    <div class="mt-2 flex items-center justify-between">
                        <span class="text-xl font-bold text-primary">{{ formatPrice(product.price) }}€</span>
                    </div>
                </div>
                <br>

    <!-- <div class="card flex justify-content-center">
        <Rating v-model="product.array_options.options_etoile" :cancel="false"  />

        <input

                      type="number"
                      v-model.number="product.array_options.options_etoile"
                      min="0"
                      class="w-16 px-2 py-1 border rounded text-center"
                      @change="updateNote(product.id, product.array_options.options_etoile)"
                    />
    </div> -->

    <div class="card flex justify-center">

        <div class="w-56">
            <InputText
            type="number"

            v-model.number="product.array_options.options_etoile"
            class="w-full mb-4 placeholder-gray-500"
            placeholder="0,00000000"
             @change="updateNote(product.id, product.array_options.options_etoile)"
            />
            <Slider v-model="product.array_options.options_etoile"
            class="w-full"
            :disabled="true"
            />
        </div>
    </div>


            </template>

            <!-- Footer avec actions -->
            <template #footer>
                <div class="flex justify-between gap-2 rounded-none">
                    <Button
                        :icon="isLiked ? 'pi pi-heart-fill' : 'pi pi-heart'"
                        @click="toggleLike"
                        class="flex-1"
                        :class="{ '!text-red-500': isLiked }"
                        text
                        :severity="isLiked ? 'danger' : 'secondary'"
                    />
                    <Button
                        :icon="isInCart ? 'pi pi-shopping-bag-fill' : 'pi pi-shopping-bag'"
                        @click="addToCart"
                        class="flex-1"
                        :class="{ '!text-primary': isInCart }"
                        text
                        severity="help"
                    />
                </div>
            </template>
        </Card>

        <Dialog
    v-model:visible="visible"
    modal
    :style="{ width: '70rem', maxWidth: '95vw', borderRadius: '0' }"
    class="overflow-hidden shadow-xl border border-gray-800"
    :breakpoints="{ '1199px': '85vw', '768px': '90vw' }"
    :pt="{
        root: { class: 'bg-[#0D0D0D]/30 border-none' },
        header: { class: 'bg-[#0D0D0D] p-4' },
        content: { class: 'bg-[#0D0D0D] p-0' },
        mask: { class: 'backdrop-blur-sm' }
    }">

    <div class="flex flex-col lg:flex-row gap-8 p-6">
        <!-- Image Container -->
        <div class="lg:w-1/2 flex items-center justify-center bg-[#1A1A1A] overflow-hidden"
             style="max-height: 480px; min-height: 320px; border-radius: 0">
            <img
                src="/img/vtt.jpg"
                :alt="product.name"
                class="object-contain w-full h-full p-4 transition-transform duration-300 hover:scale-105"
                style="max-height: 100%"
            />
        </div>

        <!-- Product Details -->
        <div class="lg:w-1/2 flex flex-col gap-6 text-[#F4F4F4]">
            <div class="flex items-center justify-between">
                <span class="font-bold text-2xl">{{ product.label }}</span>
                <span class="text-3xl font-bold text-primary">{{ product.price }}€</span>
            </div>

            <div class="space-y-4">
                <div>
                <h4 class="text-lg font-semibold text-gray-300">Description</h4>
                <p class="text-gray-400">
                    {{ product.weight}}
                    {{ getWeightValue(product.weight_units) }}

                </p>
                </div>
                <div v-if="product.details">
                    <h4 class="text-lg font-semibold text-gray-300">Détails</h4>
                    <p class="text-gray-400">{{ numberFormatter.format(product.price) }} €</p>
                </div>
                <br>


<!--
    <div class="card flex justify-content-center">
        <Rating v-model="product.array_options.options_etoile" :cancel="false"  />
        <input

                      type="number"
                      v-model.number="product.array_options.options_etoile"
                      min="0"
                      class="w-16 px-2 py-1 border rounded text-center"
                      @change="updateNote(product.id, product.array_options.options_etoile)"
                    />
    </div>

 -->



 <div class="card flex justify-center">
        <div class="w-56">
            <InputText
            type="number"

            v-model.number="product.array_options.options_etoile"
            class="w-full mb-4 placeholder-gray-500"
            placeholder="0,00000000"
             @change="updateNote(product.id, product.array_options.options_etoile)"
            />
            <Slider v-model="product.array_options.options_etoile"
            class="w-full"
            :disabled="true"
             :max="10"
            />
        </div>
    </div>


            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 mt-auto">
                <Button
                    :icon="isLiked ? 'pi pi-heart-fill' : 'pi pi-heart'"
                    @click="toggleLike"
                    :class="{ '!text-red-500': isLiked }"
                    class="flex-1 border border-gray-700 hover:bg-gray-800"
                    severity="secondary"
                    outlined
                />
                <Button
                    :icon="isInCart ? 'pi pi-shopping-bag-fill' : 'pi pi-shopping-bag'"
                    @click="addToCart"
                    :class="{ '!text-primary': isInCart }"
                    class="flex-1 border border-gray-700 hover:bg-gray-800"
                    severity="info"
                    outlined
                />
            </div>

            <Button
                label="Ajouter au panier"
                icon="pi pi-shopping-cart"
                class="w-full !bg-primary hover:!bg-primary-dark transition-all duration-300"
                severity="info"
                @click="addToCart"
            />
        </div>
    </div>
</Dialog>


    </div>
</template>
