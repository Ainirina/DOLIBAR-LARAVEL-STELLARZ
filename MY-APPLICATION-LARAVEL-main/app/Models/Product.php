<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'model', 'price', 'category_id'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function likes()
    {
        return $this->hasMany(Like::class, 'product_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }
}
