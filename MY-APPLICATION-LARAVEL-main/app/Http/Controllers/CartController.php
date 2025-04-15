<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cart(Request $request)
    {
        $userId = auth()->id();
        $productId = $request->product_id;

        $cart = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cart) {
            $cart->delete();
        } else {
            Cart::create(['user_id' => $userId, 'product_id' => $productId]);
        }
    }
    public function showMyCart(Request $request)
    {
        try {
            $userId = auth()->id();

            // 1) Récupérer les items du panier
            $cartItems = \App\Models\Cart::where('user_id', $userId)
                ->get(['product_id', 'quantity']);

            // 2) Extraire les IDs valides (> 0)
            $productIds = $cartItems->pluck('product_id')->toArray();
            $validIds   = array_filter($productIds, fn($id) => $id > 0);

            // 3) Appel API Dolibarr pour récupérer les produits
            $dolibarrProducts = [];
            if (!empty($validIds)) {
                $response = Http::withHeaders([
                    'DOLAPIKEY' => env('DOLIBARR_API_KEY'),
                ])->get(env('DOLIBARR_API_URL') . '/products', [
                    'id'    => implode(',', $validIds),
                    'limit' => count($validIds),
                ]);

                if ($response->successful()) {
                    $dolibarrProducts = $response->json();
                }
            }

            // 4) Mapper les produits
            $products = collect($dolibarrProducts)->map(function($p) {
                return [
                    'id'          => $p['id'],
                    'name'        => $p['label'] ?? ($p['name'] ?? ''),
                    'description' => $p['description'] ?? '',
                    'price'       => $p['price'] ?? 0,
                    'tva'         => $p['tva_tx'] ?? 0, // TVA ajoutée ici
                    'image'       => !empty($p['picto'])
                        ? env('DOLIBARR_API_URL') . '/images/products/' . $p['picto']
                        : null,
                ];
            })->keyBy('id')->toArray();

            // 5) Détails du panier
            $cartDetails = [];
            foreach ($cartItems as $item) {
                if (isset($products[$item->product_id])) {
                    $prod = $products[$item->product_id];
                    $cartDetails[] = [
                        'id'          => $prod['id'],
                        'name'        => $prod['name'],
                        'description' => $prod['description'],
                        'price'       => $prod['price'],
                        'tva'         => $prod['tva'],
                        'image'       => $prod['image'],
                        'quantity'    => $item->quantity,
                    ];
                }
            }

            // 6) Vue Inertia
            return Inertia::render('CartPage', [
                'cartProducts' => $cartDetails,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue.'], 500);
        }
    }


    public function updateQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:carts,product_id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Trouver le produit dans le panier
        $cart = Cart::where('product_id', $request->product_id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

        // Mettre à jour la quantité
        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->back()->with('success', 'Quantité mise à jour avec succès.');
    }


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


public function order()
{
    $userId = auth()->id(); // Récupère l'ID de l'utilisateur connecté
    if (!$userId) {
        return response()->json(['error' => 'Utilisateur non authentifié'], 401);
    }

    // 1) Récupérer les items du panier
    $cartItems = \App\Models\Cart::where('user_id', $userId)
        ->get(['product_id', 'quantity']);

        $productIds = $cartItems->pluck('product_id')->toArray();
        $validIds   = array_filter($productIds, fn($id) => $id > 0);

    if ($cartItems->isEmpty()) {
        return response()->json(['error' => 'Le panier est vide'], 400);
    }


    // 2) Extraire les IDs des produits


    $dolibarrProducts = [];
    if (!empty($validIds)) {
        $response = Http::withHeaders([
            'DOLAPIKEY' => env('DOLIBARR_API_KEY'),
        ])->get(env('DOLIBARR_API_URL') . '/products', [
            'id'    => implode(',', $validIds),
            'limit' => count($validIds),
        ]);

        if ($response->successful()) {
            $dolibarrProducts = $response->json();
        }
    }

    // 4) Mapper les produits
    $products = collect($dolibarrProducts)->map(function($p) {
        return [
            'id'          => $p['id'],
            'name'        => $p['label'] ?? ($p['name'] ?? ''),
            'description' => $p['description'] ?? '',
            'price'       => $p['price'] ?? 0,
            'tva'         => $p['tva_tx'] ?? 0, // TVA ajoutée ici
            'image'       => !empty($p['picto'])
                ? env('DOLIBARR_API_URL') . '/images/products/' . $p['picto']
                : null,
        ];
    })->keyBy('id')->toArray();
    
    // 4) Mapper les produits avec TVA et autres détails
    $products = collect($dolibarrProducts)->mapWithKeys(function($product) {
        return [
            $product['id'] => [
                'id'          => $product['id'],
                'name'        => $product['label'] ?? ($product['name'] ?? ''),
                'description' => $product['description'] ?? '',
                'price'       => $product['price'] ?? 0,
                'tva'         => $product['tva_tx'] ?? 0,
                'image'       => !empty($product['picto'])
                    ? env('DOLIBARR_API_URL') . '/images/products/' . $product['picto']
                    : null,
            ]
        ];
    })->toArray();

    // 5) Préparer les lignes de la commande
    $lines = $cartItems->map(function ($item) use ($products) {
        $product = $products[$item->product_id] ?? null;
        return $product ? [
            'fk_product' => $item->product_id,
            'qty' => $item->quantity,
            'subprice' => $product['price'],
            'tva_tx' => $product['tva'],
            'desc' => $product['description'],
        ] : null;
    })->filter()->toArray();

    if (empty($lines)) {
        return response()->json(['error' => 'Aucun produit valide dans le panier'], 400);
    }

    // 6) Données à envoyer à l'API Dolibarr
    $data = [
        'socid' => $userId,
        'date' => now()->timestamp,
        'type' => 0, // Type de commande
        'lines' => $lines,
    ];

    // 7) Envoi de la requête à l'API
    $url = env('DOLIBARR_API_URL') . '/orders';
    $apiKey = env('DOLIBARR_API_KEY');

    $response = Http::withHeaders(['DOLAPIKEY' => $apiKey])->post($url, $data);

    // Vérification du résultat
    if ($response->successful()) {
        return $response->json(); // Retourner la réponse JSON
    } else {
        return 'Erreur : ' . $response->status() . ' - ' . $response->body();
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


}
