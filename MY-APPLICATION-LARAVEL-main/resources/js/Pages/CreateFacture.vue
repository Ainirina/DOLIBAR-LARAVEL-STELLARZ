<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,router } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    factures: Array,
});
const showFacture = (facture) => {
    router.post('/factures/show', { facture }, {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Mes Factures" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Mes Factures</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div v-if="factures.length" class="space-y-6">
                        <div
                            v-for="facture in factures"
                            :key="facture.id"
                            class="border rounded-lg p-4 space-y-2"
                        >
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold">Référence: {{ facture.ref }}</h3>
                                    <p>Client: {{ facture.socid }}</p>
                                    <p>Statut: {{ facture.statut }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">
                                        Créé le: {{ new Date(facture.date_creation * 1000).toLocaleDateString() }}
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p>Total HT: {{ facture.total_ht }} €</p>
                                    <p>TVA: {{ facture.total_tva }} €</p>
                                    <p>Total TTC: {{ facture.total_ttc }} €</p>
                                </div>
                                <div>
                                    <p>Conditions de paiement: {{ facture.cond_reglement_doc }}</p>
                                    <p>Date limite: {{ new Date(facture.date_lim_reglement * 1000).toLocaleDateString() }}</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <Button
                                :label="'Voir Facture ' + facture.ref"
                                    @click="showFacture(facture)"
                                    class="flex-1"
                                    text
                                    severity="help"
                                />
                            </div>
                        </div>
                    </div>

                    <p v-else class="text-gray-500">
                        Vous n'avez aucune facture.
                    </p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
