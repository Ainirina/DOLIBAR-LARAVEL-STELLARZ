<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,router} from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';


const props = defineProps({
  orders: Array,
});

</script>

<template>
  <Head title="Mes Commandes" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl leading-tight">Mes Commandes</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div v-if="orders.length" class="space-y-6">
            <div
              v-for="order in orders"
              :key="order.id"
              class="border rounded-lg p-4"
            >
              <h3 class="text-lg font-semibold mb-2">
                Commande #{{ order.ref }} —
                {{ new Date(order.date * 1000).toLocaleDateString() }}
              </h3>

              <div class="mb-4">
                <h4 class="font-medium">Produits :</h4>
                <ul class="list-disc list-inside">
                  <li
                    v-for="(line, idx) in order.lines"
                    :key="idx"
                  >
                    {{ line.product_name }} —
                    Quantité : {{ line.quantity }} —
                    Prix unitaire : {{ line.price }}€
                  </li>
                </ul>
              </div>
<br>
              <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                <div class="text-[--Primary]">
                  <strong>Statut commande :</strong>
                  {{ order.order_status }}
                </div>
                <div class="text-[--Primary]">
                  <strong>Statut facture :</strong>
                  {{ order.invoice_status }}
                </div>
                <div class="text-[--Primary]">
                  <strong>Statut paiement :</strong>
                  {{ order.payment_status }}
                </div>
              </div>


            </div>
          </div>

          <p v-else class="text-gray-500">
            Vous n'avez aucune commande.
          </p>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
