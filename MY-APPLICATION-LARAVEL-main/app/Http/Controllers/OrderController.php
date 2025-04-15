<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function getAllOrderByIdSocid()
    {
        $socid = auth()->id();
        if (!$socid) {
            // Si non authentifié, on le redirige vers la page de login
            return redirect()->route('login');
        }

        $baseUrl = env('DOLIBARR_API_URL');
        $apiKey  = env('DOLIBARR_API_KEY');

        // 1) On récupère la liste des commandes pour ce socid
        $resOrders = Http::withHeaders(['DOLAPIKEY' => $apiKey])
            ->get($baseUrl . '/orders', ['socid' => $socid]);

        if (!$resOrders->successful()) {
            abort($resOrders->status(), 'Erreur API Dolibarr : ' . $resOrders->body());
        }

        $ordersData = [];
        foreach ($resOrders->json() as $order) {
            // 2) On récupère les lignes de chaque commande
            $resLines = Http::withHeaders(['DOLAPIKEY' => $apiKey])
                ->get($baseUrl . '/orders/' . $order['id'] . '/lines');

            $lines = [];
            if ($resLines->successful()) {
                foreach ($resLines->json() as $line) {
                    // 3) Pour chaque ligne, on va chercher le nom du produit
                    $resProd = Http::withHeaders(['DOLAPIKEY' => $apiKey])
                        ->get($baseUrl . '/products/' . $line['fk_product']);

                    $prodName = $resProd->successful()
                        ? ($resProd->json()['label'] ?? $resProd->json()['name'] ?? 'N/A')
                        : 'N/A';

                    $lines[] = [
                        'product_name' => $prodName,
                        'quantity'     => $line['qty'],
                        'price'        => $line['subprice'],
                    ];
                }
            }

            // 4) On regarde si une facture a été créée pour cette commande
            $resInv = Http::withHeaders(['DOLAPIKEY' => $apiKey])
                ->get($baseUrl . '/invoices', [
                    'sourceobject' => 'orders',
                    'sourceid'     => $order['id'],
                ]);

            $paymentStatus = 'Null'; // Valeur par défaut
            $hasInvoice    = !empty($order['billed']) && $order['billed'] == 1;
            $invoiceStatus  = $hasInvoice ? 'Facture créée' : 'Pas de facture';
            $orderId=$order['id'];
            $invoiceIds = DB::connection('dolibarr')->table('llx_element_element')
            ->where('fk_source', $orderId)
            ->where('sourcetype', 'commande')  // ou 'order' si c’est en anglais selon ta config
            ->pluck('fk_target');

                if (!empty($invoiceIds) && isset($invoiceIds[0])) {
                    $invoiceId = $invoiceIds[0];

                    // Maintenant, faire une requête à l'API Dolibarr pour récupérer les détails de la facture
                    $invoiceDetailsResponse = Http::withHeaders([
                        'DOLAPIKEY' => $apiKey, // Ajoute la clé API dans l'en-tête
                    ])->get("{$baseUrl}/invoices/{$invoiceId}");

                    // Vérifier la réponse de l'API de Dolibarr
                    if ($invoiceDetailsResponse->successful()) {
                        $invoice_data = $invoiceDetailsResponse->json();

                        // Log du résultat pour vérifier ce qui a été reçu


                        // Vérification du statut de paiement
                        $paymentStatus = (!empty($invoice_data['paye']) && $invoice_data['paye'] == 1)
                            ? 'Payé'
                            : 'Non payé';

                        // Traitement selon le statut de paiement

                    } else {
                        Log::error("Erreur lors de la récupération des détails de la facture", [
                            'status' => $invoiceDetailsResponse->status(),
                            'body' => $invoiceDetailsResponse->body()
                        ]);
                    }
                } else {
                    Log::error("Aucun ID de facture trouvé dans la réponse");
                }


            // 5) Statut de la commande : 1 = validée, sinon en attente
            $orderStatus = (isset($order['status']) && $order['status'] == 1)
                ? 'Validée'
                : 'En attente';

            $ordersData[] = [
                'id'             => $order['id'],
                'ref'            => $order['ref'] ?? $order['rowid'] ?? $order['id'],
                'date'           => $order['date'] ?? null,
                'lines'          => $lines,
                'order_status'   => $orderStatus,
                'invoice_status' => $invoiceStatus,
                'payment_status' => $paymentStatus,
            ];
        }

        // On renvoie tout ça à la vue Inertia
        return Inertia::render('OrderPage', [
            'orders' => $ordersData,
        ]);
    }
}
