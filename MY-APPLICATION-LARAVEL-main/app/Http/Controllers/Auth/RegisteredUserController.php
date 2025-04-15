<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

         // 2) Création du tiers prospect dans Dolibarr
         try {
            $response = Http::withHeaders([
                'DOLAPIKEY' => config('services.dolibarr.api_key'),
                'Accept'    => 'application/json',
            ])->post(config('services.dolibarr.url').'/thirdparties', [
                'name'        => $user->name,
                'email'       => $user->email,
                'client'      => 1,        // 0 = pas client
                'fournisseur' => 0,        // 0 = pas fournisseur
                'prospect'    => 1,        // 1 = prospect
                'status'      => 1,        // 1 = actif
            ]);

            if (! $response->successful()) {
                // loggez l’erreur pour debug
                \Log::error('Dolibarr API error', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Impossible de contacter Dolibarr', [
                'message' => $e->getMessage(),
            ]);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
