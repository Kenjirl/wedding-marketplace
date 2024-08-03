<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class WVRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_v_booking_id',
        'w_vendor_id',
        'w_v_plan_id',
        'rating',
        'komentar'
    ];

    public function w_booking(): BelongsTo {
        return $this->belongsTo(WVBooking::class, 'w_v_booking_id');
    }

    public function plan(): BelongsTo {
        return $this->belongsTo(WVPlan::class, 'w_v_plan_id');
    }
}
