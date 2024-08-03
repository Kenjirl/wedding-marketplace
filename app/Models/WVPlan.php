<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WVPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'foto' => 'array',
    ];

    protected $fillable = [
        'w_vendor_id',
        'm_jenis_vendor_id',
        'nama',
        'detail',
        'harga',
        'jenis_layanan',
        'satuan',
    ];

    public function w_vendor(): BelongsTo {
        return $this->belongsTo(WVendor::class, 'w_vendor_id');
    }

    public function jenis(): BelongsTo {
        return $this->belongsTo(MJenisVendor::class, 'm_jenis_vendor_id');
    }

    public function bookings(): HasMany {
        return $this->hasMany(WVBooking::class, 'w_v_plan_id');
    }

    public function ratings(): HasMany {
        return $this->hasMany(WVRating::class, 'w_v_plan_id');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function ($plan) {
            WVBooking::where('w_v_plan_id', $plan->id)
                ->where('status', 'diproses')
                ->update(['status' => 'ditolak']);
        });
    }
}
