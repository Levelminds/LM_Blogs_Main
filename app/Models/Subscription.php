<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'categories',
        'confirmed',
        'confirmation_token',
        'category_id',
    ];

    protected $casts = [
        'categories' => 'array',
        'confirmed' => 'boolean',
    ];
}
