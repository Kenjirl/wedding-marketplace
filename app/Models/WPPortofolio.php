<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WPPortofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_photographer_id',
        'admin_id',
        'judul',
        'tanggal',
        'detail',
        'lokasi',
        'status',
    ];

    public function w_photographer(): BelongsTo {
        return $this->belongsTo(WeddingPhotographer::class, 'wedding_photographer_id');
    }

    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function photo(): HasMany {
        return $this->hasMany(WPPortofolioPhoto::class, 'w_p_portofolio_id');
    }
}
