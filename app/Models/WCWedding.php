<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WCWedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_couple_id',
        'groom',
        'bride',
        'waktu_pemberkatan',
        'waktu_perayaan',
        'lokasi_pemberkatan',
        'lokasi_perayaan',
    ];

    public function w_couple(): BelongsTo {
        return $this->belongsTo(WCouple::class, 'w_couple_id');
    }
}
