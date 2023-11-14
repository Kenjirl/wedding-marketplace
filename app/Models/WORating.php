<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WORating extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_couple_id',
        'w_organizer_id',
        'rating',
        'komentar'
    ];

    public function w_couple(): BelongsTo {
        return $this->belongsTo(WCouple::class, 'w_couple_id');
    }

    public function w_organizer(): BelongsTo {
        return $this->belongsTo(WOrganizer::class, 'w_organizer_id');
    }
}
