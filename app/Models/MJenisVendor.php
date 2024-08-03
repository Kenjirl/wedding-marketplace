<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MJenisVendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama',
        'icon',
    ];

    public function jenis(): HasMany {
        return $this->hasMany(WVJenis::class, 'm_jenis_vendor_id');
    }

    public function portofolio(): HasMany {
        return $this->hasMany(WVPortofolio::class, 'm_jenis_vendor_id');
    }

    public function plan(): HasMany {
        return $this->hasMany(WVPlan::class, 'm_jenis_vendor_id');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function ($jenisVendor) {
            $jenisVendor->jenis()->delete();
            $jenisVendor->portofolio()->delete();
            $jenisVendor->plan()->delete();
        });

        static::restoring(function ($jenisVendor) {
            $jenisVendor->jenis()->withTrashed()->restore();
            $jenisVendor->portofolio()->withTrashed()->restore();
            $jenisVendor->plan()->withTrashed()->restore();
        });
    }
}
