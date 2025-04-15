<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;  // Modèle User, ou un modèle que vous utilisez pour la gestion des utilisateurs

class DolibarrAuthController extends Controller
{
    public function authenticateDolibarrUser(Request $request)
    {
        $client = new Client();

        // Envoyer une requête POST pour vérifier les informations d'identification
        $response = $client->request('POST', env('DOLIBARR_API_URL') . '/login', [
            'form_params' => [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . env('DOLIBARR_API_KEY'),
            ],
        ]);

        // Décoder la réponse JSON
        $data = json_decode($response->getBody(), true);

        // Vérifier le statut de la réponse
        if ($data['status'] == 'success') {
            // Authentification réussie, créez une session pour l'utilisateur
            // Vous pouvez ici rechercher l'utilisateur dans votre base de données ou créer un modèle d'utilisateur basé sur Dolibarr
            $user = User::firstOrCreate([
                'username' => $request->input('username'),
                // Ajoutez d'autres informations d'utilisateur ici
            ]);

            // Connecter l'utilisateur
            Auth::login($user);

            // Rediriger vers le dashboard
            return redirect()->route('dashboard');
        } else {
            // Authentification échouée
            return back()->withErrors(['login' => 'Invalid credentials']);
        }
    }
}
