<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::withHeaders([
            'DOLAPIKEY' => env('DOLIBARR_API_KEY'),
            'Accept' => 'application/json',
        ])->get(env('DOLIBARR_API_URL') . '/products');

        if ($response->successful()) {
            $products=$response->json();
        }
        else {
            $products=[];
        }
        // Récupération des likes et paniers utilisateur
        $userLikes = Like::where('user_id', auth()->id())->pluck('product_id');
        $userCarts = Cart::where('user_id', auth()->id())->pluck('product_id');

        return Inertia::render('Home', [
            'products' => $products,
            'userLikes' => $userLikes,
            'userCarts' => $userCarts
        ]);
    }
    public function updateNote(Request $request)
    {
        $request->validate([
            'product_id' => 'required|numeric',
            'note' => 'required|integer|min:0',
        ]);

        $response = Http::withHeaders([
            'DOLAPIKEY' => env('DOLIBARR_API_KEY'),
            'Accept' => 'application/json',
        ])->get(env('DOLIBARR_API_URL') . '/products/' . $request->product_id);

        if ($response->successful()) {
            $products=$response->json();
        }
        else {
            $products=[];
        }
        if ($products['array_options']['options_etoile'] > 0) {
            $newNote= ($products['array_options']['options_etoile'] +$request->note)/2;
        }
        else {
            $newNote=$request->note;
        }

        $responseNote = Http::withHeaders([
            'DOLAPIKEY' => env('DOLIBARR_API_KEY'),
        ])->put(env('DOLIBARR_API_URL') . '/products/' . $request->product_id, [
            'array_options' => [ 'options_etoile'=> $newNote] ,
        ]);

        if ($responseNote->successful()) {
        // console.error('new note', $products['array_options']['options_etoile']);
        return redirect()->back();
        }
        else {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour de la note.');
        }

    }

    /**
     * Récupère les produits depuis l'API Dolibarr
     */
    private function getProductsFromDolibarr()
    {
        try {
            $response = Http::withHeaders([
                'DOLAPIKEY' => env('DOLIBARR_API_KEY'),
                'Accept' => 'application/json',
            ])->get(env('DOLIBARR_API_URL') . '/products', [
                'limit' => 100, // Limite de produits à récupérer
                'sortfield' => 'rowid', // Tri par ID
                'sortorder' => 'ASC' // Ordre croissant
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            // Log l'erreur si la requête a échoué
            \Log::error('Dolibarr API Error: ' . $response->body());
            return [];

        } catch (\Exception $e) {
            \Log::error('Dolibarr API Exception: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Formate les produits Dolibarr pour votre application
     */
    private function formatDolibarrProducts(array $dolibarrProducts)
    {
        return array_map(function ($product) {
            return [
                'id' => $product['id'] ?? $product['rowid'] ?? null,
                'name' => $product['label'] ?? $product['ref'] ?? 'Produit sans nom',
                'description' => $product['description'] ?? null,
                'price' => $product['price'] ?? $product['price_net'] ?? 0,
                'image' => $this->getProductImageUrl($product),
                // Ajoutez d'autres champs nécessaires
            ];
        }, $dolibarrProducts);
    }

    /**
     * Construit l'URL de l'image du produit
     */
    private function getProductImageUrl($product)
    {
        if (!empty($product['photo'])) {
            $baseUrl = rtrim(env('DOLIBARR_API_URL'), '/api/index.php');
            return $baseUrl . '/document.php?modulepart=product&file=' . urlencode($product['photo']);
        }
        return null;
    }

    // ... (le reste de vos méthodes existantes)
}
