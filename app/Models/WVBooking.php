<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class WVBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'untuk_tanggal' => 'date',
    ];

    protected $fillable = [
        'w_c_wedding_id',
        'w_vendor_id',
        'w_v_plan_id',
        'qty',
        'status',
        'untuk_tanggal',
        'total_bayar',
        'bukti_bayar',
    ];

    public function wedding(): BelongsTo {
        return $this->belongsTo(WCWedding::class, 'w_c_wedding_id');
    }

    public function vendor(): BelongsTo {
        return $this->belongsTo(WVendor::class, 'w_vendor_id');
    }

    public function plan(): BelongsTo {
        return $this->belongsTo(WVPlan::class, 'w_v_plan_id');
    }

    public function rating(): HasOne {
        return $this->hasOne(WVRating::class, 'w_v_booking_id');
    }
}
