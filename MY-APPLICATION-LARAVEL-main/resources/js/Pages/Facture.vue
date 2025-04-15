<template>
    <AuthenticatedLayout>


        <div class="max-w-5xl mx-auto bg-white p-8 my-8 shadow-lg rounded-sm print:shadow-none" id="objectToprint">
            <!-- En-tête -->
            <div class="flex justify-between border-b-2 border-gray-800 pb-6 mb-6">
                <div class="space-y-2">
                    <img src="/logo.png" class="h-16 mb-4" alt="Logo">
                    <p class="font-bold text-lg">Entreprise XYZ</p>
                    <p>123 Rue du Commerce<br>75000 Paris<br>SIRET: 123 456 789 00001</p>
                </div>

                <div class="text-right">
                    <h1 class="text-3xl font-bold mb-4">FACTURE</h1>
                    <p class="font-semibold">N° {{ facture.ref }}</p>
                    <p>Date : {{ formatDate(facture.date_creation) }}</p>
                    <p>Échéance : {{ formatDate(facture.date_lim_reglement) }}</p>
                </div>
            </div>

            <!-- Client -->
            <div class="mb-8">
                <p class="font-bold mb-2">Client :</p>
                <p>Société ID: {{ facture.socid }}</p>
                <!-- Ajouter les informations client ici -->
            </div>

            <!-- Tableau des articles -->
            <table class="w-full mb-8">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left py-3 px-4">Description</th>
                        <th class="text-right py-3 px-4">Prix Unitaire</th>
                        <th class="text-right py-3 px-4">Quantité</th>
                        <th class="text-right py-3 px-4">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(line, index) in facture.lines" :key="index" class="border-b">
                        <td class="py-3 px-4">{{ line.ref }}</td>
                        <td class="text-right py-3 px-4">{{ line.subprice }} €</td>
                        <td class="text-right py-3 px-4">{{ line.qty }}</td>
                        <td class="text-right py-3 px-4">{{ line.multicurrency_total_ht }} €</td>
                    </tr>
                    <tr v-if="!facture.lines.length">
                        <td colspan="4" class="text-center py-4 text-gray-500">Aucun article</td>
                    </tr>
                </tbody>
            </table>

            <!-- Total -->
            <div class="grid grid-cols-2 gap-4 max-w-md ml-auto border-t-2 pt-4">
                <div class="text-right font-semibold">Total HT :</div>
                <div class="text-right">{{ facture.total_ht }} €</div>

                <div class="text-right font-semibold">TVA ({{ facture.tva_rate || '20%' }}) :</div>
                <div class="text-right">{{ facture.total_tva }} €</div>

                <div class="text-right font-bold text-lg">Total TTC :</div>
                <div class="text-right font-bold text-lg">{{ facture.total_ttc }} €</div>
            </div>
<br>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl leading-tight">Facture {{ facture.ref }}</h2>
                <button
                    @click="printFacture"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 print:hidden"
                >
                    Imprimer/PDF
                </button>
            </div>
<br>
            <!-- Footer -->
            <div class="mt-12 text-sm text-gray-500 text-center">
                <p>Entreprise XYZ - Capital social : 10 000 € - RCS Paris 123 456 789</p>
                <p>Facture établie électroniquement - Article 289-VII du CGI</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
    facture: Object,
});

const formatDate = (timestamp) => {
    if (!timestamp) return 'N/A';
    return new Date(timestamp * 1000).toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};

const printFacture = () => {
    const printContent = document.getElementById('objectToprint').innerHTML;
    const styles = Array.from(document.querySelectorAll('link[rel="stylesheet"], style'))
        .map(el => el.outerHTML)
        .join('');

    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <!DOCTYPE html>
        <html>
            <head>
                <title>Facture ${props.facture.ref}</title>
                ${styles}
                <style>
                    /* Styles spécifiques à l'impression */
                    @page { margin: 20mm; }
                    body {
                        -webkit-print-color-adjust: exact !important;
                        print-color-adjust: exact !important;
                        margin: 0 auto !important;
                        max-width: 1200px !important;
                    }
                    .print-hidden { display: none !important; }
                    a { text-decoration: none !important; }
                </style>
            </head>
            <body class="bg-white">
                <div class="mx-auto p-8">${printContent}</div>
                <script>
                    // Force le chargement des polices
                    setTimeout(() => window.print(), 300);
                <\/script>
            </body>
        </html>
    `);

    printWindow.document.close();

    // Gestion des images et polices
    printWindow.onload = () => {
        setTimeout(() => {
            printWindow.print();
            printWindow.close();
        }, 1000);
    };
};
</script>

<style>
@media print {
    body {
        background: white !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    #objectToprint {
        box-shadow: none !important;
        padding: 0 !important;
    }

    .print-hidden {
        display: none !important;
    }

    a[href]::after {
        content: none !important;
    }
}
</style>
