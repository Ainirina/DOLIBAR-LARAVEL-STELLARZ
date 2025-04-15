<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DolibarrApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('dolibarr')->group(function () {
    // Tiers
    Route::get('thirdparties', [DolibarrApiController::class, 'getThirdParties']);
    Route::post('thirdparties', [DolibarrApiController::class, 'createThirdParty']);

    // Factures
    Route::get('invoices/{id}', [DolibarrApiController::class, 'getInvoice']);

    // Produits
    Route::get('products', [DolibarrApiController::class, 'getProducts']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
