<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WCGroupGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_c_wedding_id',
        'nama',
        'link_grup',
        'link',
        'status',
    ];

    public function wedding(): BelongsTo {
        return $this->belongsTo(WCWedding::class, 'w_c_wedding_id');
    }
}
