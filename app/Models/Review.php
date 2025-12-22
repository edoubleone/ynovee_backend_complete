<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'feedback',
        'rating',
        'image_url',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];
}
