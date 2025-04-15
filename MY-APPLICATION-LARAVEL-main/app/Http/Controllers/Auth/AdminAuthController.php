<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Dashboard Admin : affiche stats ventes + liste commandes
     */
    public function dashboard()
    {
        // 1) Période = année en cours
        $year     = Carbon::now()->year;
        $fromDate = Carbon::create($year, 1, 1)->timestamp;
        $toDate   = Carbon::create($year, 12, 31)->timestamp;

        // 2) Récupérer toutes les commandes validées
        $baseUrl = env('DOLIBARR_API_URL');
        $apiKey  = env('DOLIBARR_API_KEY');

        $resOrders = Http::withHeaders(['DOLAPIKEY' => $apiKey])
            ->get($baseUrl . '/orders', [
                'status'   => 1,
                'datefrom' => $fromDate,
                'dateto'   => $toDate,
            ]);
        $ordersRaw = $resOrders->successful() ? $resOrders->json() : [];

        // 3) CA mensuel
        $salesByMonth = collect(range(1,12))->mapWithKeys(fn($m) => [$m => 0]);
        foreach ($ordersRaw as $o) {
            $total = $o['total_ttc'] ?? $o['total_ht'] ?? 0;
            $m     = Carbon::createFromTimestamp($o['date'])->month;
            $salesByMonth[$m] += $total;
        }
        $labels = $salesByMonth->keys()
                    ->map(fn($m) => Carbon::create()->month($m)->format('M'))
                    ->toArray();
        $data   = array_values($salesByMonth->toArray());

        // 4) Détail commandes + calculs pour autres stats
        $detailed      = [];
        $productSales  = [];            // [id => ['name'=>..., 'qty'=>...]]
        $orderStatusCounts   = ['Validée'=>0, 'En attente'=>0];
        $invoiceStatusCounts = ['Facture créée'=>0, 'Pas de facture'=>0];
        $paymentStatusCounts = ['Payé'=>0, 'Non payé'=>0];

        foreach ($ordersRaw as $order) {
            // lignes
            $resLines = Http::withHeaders(['DOLAPIKEY' => $apiKey])
                ->get($baseUrl . '/orders/' . $order['id'] . '/lines');

            $lines = [];
            if ($resLines->successful()) {
                foreach ($resLines->json() as $line) {
                    // nom du produit
                    $resProd = Http::withHeaders(['DOLAPIKEY' => $apiKey])
                        ->get($baseUrl . '/products/' . $line['fk_product']);
                    $prodName = $resProd->successful()
                        ? ($resProd->json()['label'] ?? $resProd->json()['name'] ?? 'N/A')
                        : 'N/A';

                    // remplir lines
                    $lines[] = [
                        'product_id'   => $line['fk_product'],
                        'product_name' => $prodName,
                        'quantity'     => $line['qty'],
                        'price'        => $line['subprice'],
                    ];

                    // cumul produit
                    $pid = $line['fk_product'];
                    $productSales[$pid]['name'] = $prodName;
                    $productSales[$pid]['qty']  = ($productSales[$pid]['qty'] ?? 0) + $line['qty'];
                }
            }

            // statuts
            $orderStatus = ($order['status'] ?? 0) == 1 ? 'Validée' : 'En attente';
            $orderStatusCounts[$orderStatus]++;

            // factures
            $resInv = Http::withHeaders(['DOLAPIKEY' => $apiKey])
                ->get($baseUrl . '/invoices', [
                    'sourceobject' => 'orders',
                    'sourceid'     => $order['id'],
                ]);
            $hasInv = $resInv->successful() && count($resInv->json()) > 0;
            $invStat = $hasInv ? 'Facture créée' : 'Pas de facture';
            $invoiceStatusCounts[$invStat]++;

            // paiements
            $payStat = 'Non payé';
            if ($hasInv) {
                $inv = $resInv->json()[0];
                $payStat = (!empty($inv['paye']) && $inv['paye']) ? 'Payé' : 'Non payé';
            }
            $paymentStatusCounts[$payStat]++;

            $detailed[] = [
                'ref'             => $order['ref'] ?? $order['rowid'] ?? $order['id'],
                'date'            => $order['date'],
                'lines'           => $lines,
                'order_status'    => $orderStatus,
                'invoice_status'  => $invStat,
                'payment_status'  => $payStat,
            ];
        }

        // 5) Préparer arrays pour graphiques
        $productLabels = array_column($productSales, 'name');
        $productData   = array_column($productSales, 'qty');

        $orderStatusLabels = array_keys($orderStatusCounts);
        $orderStatusData   = array_values($orderStatusCounts);

        $invoiceStatusLabels = array_keys($invoiceStatusCounts);
        $invoiceStatusData   = array_values($invoiceStatusCounts);

        $paymentStatusLabels = array_keys($paymentStatusCounts);
        $paymentStatusData   = array_values($paymentStatusCounts);

        return view('admin.Dashboard', compact(
            'labels','data','detailed',
            'productLabels','productData',
            'orderStatusLabels','orderStatusData',
            'invoiceStatusLabels','invoiceStatusData',
            'paymentStatusLabels','paymentStatusData'
        ));
    }


    public function showLoginForm()
    {
        return view('admin.pages.auth.login');
    }

    public function verifyPin(Request $request)
    {
        $request->validate([
            'pin_code' => 'required|digits:4|numeric',
        ]);

        $correctPin = "2872";
        if ($request->pin_code === $correctPin) {
            Session::put('admin_logged_in', true);
            return redirect()->route('admin');
        }
        else{
            return redirect()->route('admin-Login');
        }

    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        return redirect()->route('admin.index');
    }
}
