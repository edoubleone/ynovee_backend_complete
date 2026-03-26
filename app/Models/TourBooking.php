<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourBooking extends Model
{
    protected $fillable = [
        'tour_id',
        'booking_date',
        'guests_count',
        'customer_name',
        'customer_email',
        'customer_phone',
        'total_price',
        'currency',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
