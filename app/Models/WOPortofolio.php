<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WOPortofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_organizer_id',
        'admin_id',
        'judul',
        'tanggal',
        'detail',
        'lokasi',
        'status',
    ];

    public function w_organizer(): BelongsTo {
        return $this->belongsTo(WeddingOrganizer::class, 'wedding_organizer_id');
    }

    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function photo(): HasMany {
        return $this->hasMany(WOPortofolioPhoto::class, 'w_o_portofolio_id');
    }
}
