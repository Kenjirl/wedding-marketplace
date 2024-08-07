<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WCWeddingDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'koordinat' => 'array',
    ];

    protected $fillable = [
        'w_c_wedding_id',
        'm_event_id',
        'waktu',
        'lokasi',
    ];

    public function wedding(): BelongsTo {
        return $this->belongsTo(WCWedding::class, 'w_c_wedding_id');
    }

    public function event(): BelongsTo {
        return $this->belongsTo(MEvent::class, 'm_event_id')->withTrashed();
    }
}
