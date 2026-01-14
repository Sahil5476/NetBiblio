<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    // ADD THIS LINE TO FIX THE ERROR
    protected $table = 'wishlist'; 

    protected $fillable = [
        'user_id',
        'product_id',
        'name',
        'price',
        'image'
    ];
}