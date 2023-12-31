<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WCWedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_couple_id',
        'groom',
        'bride',
    ];

    public function w_couple(): BelongsTo {
        return $this->belongsTo(WCouple::class, 'w_couple_id');
    }

    public function w_detail(): HasMany {
        return $this->hasMany(WCWeddingDetail::class, 'w_c_wedding_id');
    }

    public function w_o_booking(): HasOne {
        return $this->hasOne(WOBooking::class, 'w_c_wedding_id');
    }

    public function w_p_booking(): HasMany {
        return $this->hasMany(WPBooking::class, 'w_c_wedding_id');
    }
}
