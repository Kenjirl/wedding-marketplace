<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WVPortofolio extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'foto' => 'array',
        'koordinat' => 'array',
    ];

    protected $fillable = [
        'w_vendor_id',
        'm_jenis_vendor_id',
        'admin_id',
        'judul',
        'tanggal',
        'detail',
        'lokasi',
        'status',
    ];

    public function w_vendor(): BelongsTo {
        return $this->belongsTo(WVendor::class, 'w_vendor_id');
    }

    public function jenis(): BelongsTo {
        return $this->belongsTo(MJenisVendor::class, 'm_jenis_vendor_id');
    }

    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
