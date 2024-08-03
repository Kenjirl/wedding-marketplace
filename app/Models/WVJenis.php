<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WVJenis extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'w_vendor_id',
        'm_jenis_vendor_id',
    ];

    public function master(): BelongsTo {
        return $this->belongsTo(MJenisVendor::class, 'm_jenis_vendor_id');
    }

    public function w_vendor(): BelongsTo {
        return $this->belongsTo(WVendor::class, 'w_vendor_id');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function ($jenis) {
            WVPortofolio::where('m_jenis_vendor_id', $jenis->m_jenis_vendor_id)
                ->where('w_vendor_id', $jenis->w_vendor_id)
                ->delete();

            WVBooking::whereHas('plan', function ($query) use ($jenis) {
                $query->where('m_jenis_vendor_id', $jenis->m_jenis_vendor_id)
                    ->where('w_vendor_id', $jenis->w_vendor_id);
                })
                ->where('status', 'diproses')
                ->update(['status' => 'ditolak']);

            WVPlan::where('m_jenis_vendor_id', $jenis->m_jenis_vendor_id)
                ->where('w_vendor_id', $jenis->w_vendor_id)
                ->delete();
        });

        static::restoring(function ($jenis) {
            WVPortofolio::withTrashed()
                ->where('m_jenis_vendor_id', $jenis->m_jenis_vendor_id)
                ->where('w_vendor_id', $jenis->w_vendor_id)
                ->restore();

            WVPlan::withTrashed()
                ->where('m_jenis_vendor_id', $jenis->m_jenis_vendor_id)
                ->where('w_vendor_id', $jenis->w_vendor_id)
                ->restore();
        });
    }
}
