<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WPhotographer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'no_telp',
        'gender',
        'basis_operasi',
        'kota_operasi',
        'status',
        'alamat',
        'foto_profil',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function portofolio(): HasMany {
        return $this->hasMany(WPPortofolio::class, 'w_photographer_id');
    }

    public function plan(): HasMany {
        return $this->hasMany(WPPlan::class, 'w_photographer_id');
    }

    public function rating(): HasMany {
        return $this->hasMany(WPRating::class, 'w_photographer_id');
    }
}
