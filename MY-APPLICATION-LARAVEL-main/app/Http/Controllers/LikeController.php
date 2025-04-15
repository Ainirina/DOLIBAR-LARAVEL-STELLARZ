<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LikeController extends Controller
{
    // Ajouter ou retirer un like
    public function like(Request $request)
    {
        $userId = auth()->id();
        $productId = $request->product_id;
    
        $like = Like::where('user_id', $userId)->where('product_id', $productId)->first();
    
        if ($like) {
            $like->delete();
        } else {
            Like::create(['user_id' => $userId, 'product_id' => $productId]);
        }
    }

    public function showLikedProduct(Request $request)
    {
        $userId = auth()->id();
    
        $likedProducts = Product::whereHas('likes', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
    
        return Inertia::render('LikePage', [
            'likedProducts' => $likedProducts
        ]);
    }
}