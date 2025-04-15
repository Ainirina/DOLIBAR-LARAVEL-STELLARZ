<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DolibarrProductController extends Controller
{
    // Récupérer tous les produits
    public function index()
    {
        // Appel API Dolibarr pour obtenir les produits
        $response = Http::withHeaders([
            'DOLAPIKEY' => env('DOLIBARR_API_KEY'),
            'Accept' => 'application/json',
        ])->get(env('DOLIBARR_API_URL') . '/products');

        if ($response->successful()) {
            // Renvoyer la vue avec les produits récupérés
            return Inertia::render('Products/Index', [
                'products' => $response->json(),
            ]);
        } else {
            // Renvoyer une erreur si l'appel échoue
            return Inertia::render('Error', [
                'error' => 'Erreur lors de la récupération des produits',
            ]);
        }
    }

    // Récupérer un produit par ID
    public function show($id)
    {
        // Appel API Dolibarr pour obtenir un produit spécifique
        $response = Http::withHeaders([
            'DOLAPIKEY' => env('DOLIBARR_API_KEY'),
            'Accept' => 'application/json',
        ])->get(env('DOLIBARR_API_URL') . '/products/' . $id);

        if ($response->successful()) {
            // Renvoyer la vue avec le produit spécifique
            return Inertia::render('Products/Show', [
                'product' => $response->json(),
            ]);
        } else {
            // Renvoyer une erreur si le produit n'est pas trouvé
            return Inertia::render('Error', [
                'error' => 'Produit non trouvé',
            ]);
        }
    }

    // Mettre à jour un produit avec une nouvelle note
    public function updateNote(Request $request)
    {
        $productId = $request->product_id;
        $newNote = $request->new_note; // La nouvelle note (options_etoile)

        // Validation des données
        $request->validate([
            'product_id' => 'required|numeric',
            'new_note' => 'required|numeric|min:0|max:5', // Validation de la note, entre 0 et 5
        ]);

        // Appel API Dolibarr pour mettre à jour la note (options_etoile)
        $response = Http::withHeaders([
            'DOLAPIKEY' => env('DOLIBARR_API_KEY'),
        ])->put(env('DOLIBARR_API_URL') . '/products/' . $productId, [
            'array_options' => [
                'options_etoile' => $newNote, // Mettre à jour l'option etoile
            ],
        ]);

        if ($response->successful()) {
            // Renvoyer la vue avec le produit mis à jour
            return Inertia::render('Products/Show', [
                'product' => $response->json(),
            ]);
        } else {
            // Renvoyer une erreur si la mise à jour échoue
            return Inertia::render('Error', [
                'error' => 'Erreur lors de la mise à jour de la note',
            ]);
        }
    }

    // Créer un produit
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // Appel API Dolibarr pour créer un produit
        $response = Http::withHeaders([
            'DOLAPIKEY' => env('DOLIBARR_API_KEY'),
            'Accept' => 'application/json',
        ])->post(env('DOLIBARR_API_URL') . '/products', [
            'name' => $request->name,
            'price' => $request->price,
        ]);

        if ($response->successful()) {
            // Renvoyer la vue avec les produits mis à jour après création
            return Inertia::render('Products/Index', [
                'products' => $response->json(),
            ]);
        } else {
            // Renvoyer une erreur si la création échoue
            return Inertia::render('Error', [
                'error' => 'Erreur lors de la création du produit',
            ]);
        }
    }

    // Supprimer un produit
    public function destroy($id)
    {
        // Appel API Dolibarr pour supprimer un produit
        $response = Http::withHeaders([
            'DOLAPIKEY' => env('DOLIBARR_API_KEY'),
            'Accept' => 'application/json',
        ])->delete(env('DOLIBARR_API_URL') . '/products/' . $id);

        if ($response->successful()) {
            // Renvoyer la vue avec les produits mis à jour après suppression
            return Inertia::render('Products/Index', [
                'products' => $response->json(),
            ]);
        } else {
            // Renvoyer une erreur si la suppression échoue
            return Inertia::render('Error', [
                'error' => 'Erreur lors de la suppression du produit',
            ]);
        }
    }
}
