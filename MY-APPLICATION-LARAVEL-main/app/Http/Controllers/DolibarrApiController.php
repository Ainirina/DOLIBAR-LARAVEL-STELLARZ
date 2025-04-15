<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DolibarrApiController extends Controller
{
    private $apiBaseUrl;
    private $apiKey;

    public function __construct()
    {
        $this->apiBaseUrl = env('DOLIBARR_API_URL');
        $this->apiKey = env('DOLIBARR_API_KEY');
    }

    /**
     * Méthode générique pour les requêtes GET
     */
    public function getFromDolibarr($endpoint, $params = [])
    {
        try {
            $response = Http::withHeaders([
                'DOLAPIKEY' => $this->apiKey,
                'Accept' => 'application/json',
            ])->get($this->apiBaseUrl . $endpoint, $params);

            return $response->successful()
                ? $response->json()
                : $this->handleError($response);

        } catch (\Exception $e) {
            Log::error('Dolibarr API GET Error: ' . $e->getMessage());
            return response()->json(['error' => 'API request failed'], 500);
        }
    }

    /**
     * Méthode générique pour les requêtes POST
     */
    public function postToDolibarr($endpoint, $data = [])
    {
        try {
            $response = Http::withHeaders([
                'DOLAPIKEY' => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($this->apiBaseUrl . $endpoint, $data);

            return $response->successful()
                ? $response->json()
                : $this->handleError($response);

        } catch (\Exception $e) {
            Log::error('Dolibarr API POST Error: ' . $e->getMessage());
            return response()->json(['error' => 'API request failed'], 500);
        }
    }

    /**
     * Gestion des erreurs API
     */
    private function handleError($response)
    {
        Log::error('Dolibarr API Error: ' . $response->body());
        return response()->json([
            'error' => 'API request failed',
            'details' => $response->json() ?? $response->body()
        ], $response->status());
    }

    // =============================================
    // EXEMPLES DE MÉTHODES SPÉCIFIQUES
    // =============================================

    /**
     * Récupérer la liste des tiers
     */
    public function getThirdParties()
    {
        return $this->getFromDolibarr('/thirdparties');
    }

    /**
     * Créer un nouveau tiers
     */
    public function createThirdParty(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'client' => 'nullable|integer',
            'supplier' => 'nullable|integer',
            'email' => 'nullable|email',
        ]);

        return $this->postToDolibarr('/thirdparties', $validated);
    }

    /**
     * Récupérer une facture par son ID
     */
    public function getInvoice($id)
    {
        return $this->getFromDolibarr("/invoices/$id");
    }

    /**
     * Récupérer la liste des produits
     */
    public function getProducts()
    {
        return $this->getFromDolibarr('/products');
    }
}
