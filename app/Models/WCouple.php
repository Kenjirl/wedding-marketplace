<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WCouple extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'no_telp',
        'gender',
        'foto_profil',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function wedding(): HasMany {
        return $this->hasMany(WCWedding::class, 'w_couple_id');
    }

    public function w_o_rating(): HasMany {
        return $this->hasMany(WORating::class, 'w_couple_id');
    }

    public function w_p_rating(): HasMany {
        return $this->hasMany(WPRating::class, 'w_couple_id');
    }
}
