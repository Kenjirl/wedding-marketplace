<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

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

    public function plan(): HasOneThrough {
        return $this->hasOneThrough(WVPlan::class, WVBooking::class, 'id', 'id', 'w_v_booking_id', 'w_v_plan_id');
    }
}
