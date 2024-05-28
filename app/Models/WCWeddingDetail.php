<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WCWeddingDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'w_c_wedding_id',
        'w_event_id',
        'waktu',
        'lokasi',
    ];

    public function wedding(): BelongsTo {
        return $this->belongsTo(WCWedding::class, 'w_c_wedding_id');
    }

    public function event(): BelongsTo {
        return $this->belongsTo(WEvent::class, 'w_event_id');
    }
}
