<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'capacity',
        'price_usd',
        'price_eur',
        'price_ghs',
        'amenities',
        'images',
        'total_rooms',
    ];

    protected $casts = [
        'amenities' => 'array',
        'images' => 'array',
        'price_usd' => 'decimal:2',
        'price_eur' => 'decimal:2',
        'price_ghs' => 'decimal:2',
    ];
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
