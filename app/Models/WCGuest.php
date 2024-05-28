<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WCGuest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'w_c_wedding_id',
        'nama',
        'no_telp',
        'gender',
        'link',
        'status',
        'respon',
        'alasan',
        'jumlah',
        'pesan',
    ];

    public function wedding(): BelongsTo {
        return $this->belongsTo(WCWedding::class, 'w_c_wedding_id');
    }
}
