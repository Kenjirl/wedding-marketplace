<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WPRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_couple_id',
        'w_photographer_id',
        'rating',
        'komentar'
    ];

    public function w_couple(): BelongsTo {
        return $this->belongsTo(WCouple::class, 'w_couple_id');
    }

    public function w_photographer(): BelongsTo {
        return $this->belongsTo(WPhotographer::class, 'w_photographer_id');
    }
}
