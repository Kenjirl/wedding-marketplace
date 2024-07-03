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
        'c_header'  => 'array',
        'c_quote'   => 'array',
        'c_profile' => 'array',
        'c_event' => 'array',
        'c_gallery' => 'array',
        'c_wish'    => 'array',
        'c_footer'  => 'array',
    ];

    protected $guarded = [
        'id',
    ];

    public function wedding(): BelongsTo {
        return $this->belongsTo(WCWedding::class, 'w_c_wedding_id');
    }
}
