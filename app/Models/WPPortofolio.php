<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WPPortofolio extends Model
{
    use HasFactory;

    protected $casts = [
        'foto' => 'array',
    ];

    protected $fillable = [
        'w_photographer_id',
        'admin_id',
        'judul',
        'tanggal',
        'detail',
        'lokasi',
        'status',
    ];

    public function w_photographer(): BelongsTo {
        return $this->belongsTo(WPhotographer::class, 'w_photographer_id');
    }

    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
