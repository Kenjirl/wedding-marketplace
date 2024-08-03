<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WCInvitation extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'header'  => 'array',
        'quote'   => 'array',
        'profile' => 'array',
        'event'   => 'array',
        'gallery' => 'array',
        'wish'    => 'array',
        'info'    => 'array',
        'footer'  => 'array',
    ];

    protected $guarded = [
        'id',
    ];

    public function wedding(): BelongsTo {
        return $this->belongsTo(WCWedding::class, 'w_c_wedding_id');
    }
}
