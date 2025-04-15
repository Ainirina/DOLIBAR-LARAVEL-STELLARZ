<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;


class FactureController extends Controller
{
    public function getFacturebyId(Request $request)
    {
        $socid = auth()->id();
        if (!$socid) {
            // Si non authentifié, on le redirige vers la page de login
            return redirect()->route('login');
        }

        return Inertia::render('Facture', [
            'facture' => $request->facture,
        ]);
    }
    public function getFacture()
    {

        $socid = auth()->id();
        if (!$socid) {
            // Si non authentifié, on le redirige vers la page de login
            return redirect()->route('login');
        }

        $baseUrl = env('DOLIBARR_API_URL');
        $apiKey  = env('DOLIBARR_API_KEY');


        $response = Http::withHeaders(['DOLAPIKEY' => $apiKey])
        ->get($baseUrl . '/invoices', ['socid' => $socid]);

        if ($response->successful()) {
            $facture=$response->json();
        }
        else {
            $facture=[];
        }

        return Inertia::render('CreateFacture', [
            'factures' => $facture,

        ]);
    }
}
