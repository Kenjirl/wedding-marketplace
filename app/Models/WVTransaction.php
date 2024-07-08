<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WVTransaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function booking(): BelongsTo {
        return $this->belongsTo(WVBooking::class, 'w_v_booking_id');
    }
}
