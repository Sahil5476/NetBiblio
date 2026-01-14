<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Explicitly define the table name to be safe
    protected $table = 'products';

    // Allow these columns to be filled
    protected $fillable = [
        'name',
        'price',
        'image'
    ];
}