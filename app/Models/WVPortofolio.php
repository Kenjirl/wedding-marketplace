<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WVPortofolio extends Model
{
    use HasFactory;

    protected $casts = [
        'foto' => 'array',
    ];

    protected $fillable = [
        'w_vendor_id',
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

    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
