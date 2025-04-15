<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $socid   = auth()->id();
        $baseUrl = env('DOLIBARR_API_URL');
        $apiKey  = env('DOLIBARR_API_KEY');

        // 1) Récupérer toutes les commandes validées de l'année en cours
        $year     = Carbon::now()->year;
        $fromDate = Carbon::create($year, 1, 1)->timestamp;
        $toDate   = Carbon::create($year, 12, 31)->timestamp;

        $resOrders = Http::withHeaders(['DOLAPIKEY' => $apiKey])
            ->get($baseUrl . '/orders', [
                'socid'    => $socid,
                'status'   => 1,
                'datefrom' => $fromDate,
                'dateto'   => $toDate,
            ]);

        $orders = $resOrders->successful() ? $resOrders->json() : [];

        // 2) Calculer le CA mensuel
        $salesByMonth = collect(range(1,12))->mapWithKeys(fn($m) => [$m => 0]);
        foreach ($orders as $o) {
            $total = $o['total_ttc'] ?? $o['total_ht'] ?? 0;
            $m = Carbon::createFromTimestamp($o['date'])->month;
            $salesByMonth[$m] += $total;
        }

        $labels = $salesByMonth->keys()
                    ->map(fn($m) => Carbon::create()->month($m)->format('M'))
                    ->toArray();
        $data   = array_values($salesByMonth->toArray());

        // 3) Pour chaque commande, on va chercher ses lignes + statuts
        $detailed = [];
        foreach ($orders as $order) {
            $resLines = Http::withHeaders(['DOLAPIKEY' => $apiKey])
                ->get($baseUrl . '/orders/' . $order['id'] . '/lines');
            $lines = [];
            if ($resLines->successful()) {
                foreach ($resLines->json() as $line) {
                    // récupérer nom du produit
                    $resProd = Http::withHeaders(['DOLAPIKEY' => $apiKey])
                        ->get($baseUrl . '/products/' . $line['fk_product']);
                    $name = $resProd->successful()
                        ? ($resProd->json()['label'] ?? $resProd->json()['name'] ?? 'N/A')
                        : 'N/A';
                    $lines[] = [
                        'product_name' => $name,
                        'quantity'     => $line['qty'],
                        'price'        => $line['subprice'],
                    ];
                }
            }

            // statuts facture / paiement
            $resInv = Http::withHeaders(['DOLAPIKEY' => $apiKey])
                ->get($baseUrl . '/invoices', [
                    'sourceobject' => 'orders',
                    'sourceid'     => $order['id'],
                ]);
            $hasInvoice = $resInv->successful() && count($resInv->json()) > 0;
            $invoiceStatus = $hasInvoice ? 'Facture créée' : 'Pas de facture';
            $paymentStatus = 'Non payé';
            if ($hasInvoice) {
                $inv = $resInv->json()[0];
                $paymentStatus = (!empty($inv['paye']) && $inv['paye']) ? 'Payé' : 'Non payé';
            }

            $orderStatus = ($order['status'] ?? 0) == 1 ? 'Validée' : 'En attente';

            $detailed[] = [
                'ref'             => $order['ref'] ?? $order['rowid'],
                'date'            => $order['date'],
                'lines'           => $lines,
                'order_status'    => $orderStatus,
                'invoice_status'  => $invoiceStatus,
                'payment_status'  => $paymentStatus,
            ];
        }

        return view('admin.dashboard', [
            'labels' => $labels,
            'data'   => $data,
            'orders' => $detailed,
        ]);
    }
}
