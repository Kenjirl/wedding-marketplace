<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'admin_id',
        'nama',
        'keterangan',
        'jenis',
    ];

    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function w_detail(): HasMany {
        return $this->hasMany(WCWeddingDetail::class, 'm_event_id');
    }
}
