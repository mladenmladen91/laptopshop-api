<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'brand_image',
        'price',
        'price_old',
        'saving',
        'small_image',
        'image',
        'big_image',
        'gift_url',
        'stock',
        'rating',
        'votes',
        'shock',
        'top',
        'category_id',
        'description'
    ];

    public function specifications(){
        return $this->hasMany(Specification::class);
    }
}
