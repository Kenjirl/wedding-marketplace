<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WCInvitation extends Model
{
    use HasFactory;

    protected $casts = [
        't_gallery' => 'array',
        'c_profile' => 'array',
        'c_gallery' => 'array',
        'c_qr'      => 'array',
    ];

    protected $fillable = [
        'w_c_wedding_id',
        't_header',
        't_quote',
        't_profile',
        't_gallery',
        't_wish',
        't_qr',
        't_footer',

        'c_quote',
        'c_profile',
        'c_gallery',
        'c_qr',
    ];

    public function wedding(): BelongsTo {
        return $this->belongsTo(WCWedding::class, 'w_c_wedding_id');
    }
}
