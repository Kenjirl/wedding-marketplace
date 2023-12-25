<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'nama',
        'keterangan',
        'jenis',
        'deleted',
    ];

    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function w_detail(): HasMany {
        return $this->hasMany(WCWeddingDetail::class, 'w_event_id');
    }
}
