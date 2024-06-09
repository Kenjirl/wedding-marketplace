<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WVendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'rekening' => 'array',
    ];

    protected $fillable = [
        'user_id',
        'nama',
        'no_telp',
        'alamat',
        'basis_operasi',
        'kota_operasi',
        'foto_profil',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function portofolio(): HasMany {
        return $this->hasMany(WVPortofolio::class, 'w_vendor_id');
    }

    public function plan(): HasMany {
        return $this->hasMany(WVPlan::class, 'w_vendor_id');
    }

    public function bookings(): HasMany {
        return $this->hasMany(WVBooking::class, 'w_vendor_id');
    }
}
