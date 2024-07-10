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
}
