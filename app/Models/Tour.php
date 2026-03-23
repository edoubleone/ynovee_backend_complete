<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'duration',
        'price_usd',
        'price_eur',
        'price_ghs',
        'max_guests',
        'category',
        'inclusions',
        'exclusions',
        'images',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'inclusions' => 'array',
        'exclusions' => 'array',
        'images' => 'array',
        'is_featured' => 'boolean',
        'price_usd' => 'decimal:2',
        'price_eur' => 'decimal:2',
        'price_ghs' => 'decimal:2',
    ];

    public function bookings()
    {
        return $this->hasMany(TourBooking::class);
    }
}
