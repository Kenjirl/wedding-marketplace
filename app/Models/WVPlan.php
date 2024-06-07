<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class WVPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'foto' => 'array',
    ];

    protected $fillable = [
        'w_vendor_id',
        'nama',
        'detail',
        'harga',
        'satuan',
    ];

    public function w_vendor(): BelongsTo {
        return $this->belongsTo(WVendor::class, 'w_vendor_id');
    }

    public function bookings(): HasMany {
        return $this->hasMany(WVBooking::class, 'w_v_plan_id');
    }

    public function ratings(): HasManyThrough {
        return $this->hasManyThrough(WVRating::class, WVBooking::class, 'w_v_plan_id', 'w_v_booking_id');
    }
}
