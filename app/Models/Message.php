<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // This allows the Contact form to save these specific fields
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'number',
        'message'
    ];
}