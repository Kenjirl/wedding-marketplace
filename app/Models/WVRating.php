<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WVRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_v_booking_id',
        'rating',
        'komentar'
    ];

    public function w_booking(): BelongsTo {
        return $this->belongsTo(WVBooking::class, 'w_v_booking_id');
    }
}
