<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WPRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_couple_id',
        'wedding_photographer_id',
        'rating',
        'komentar'
    ];

    public function w_couple(): BelongsTo {
        return $this->belongsTo(WeddingCouple::class, 'wedding_couple_id');
    }

    public function w_photographer(): BelongsTo {
        return $this->belongsTo(WeddingPhotographer::class, 'wedding_photographer_id');
    }
}
