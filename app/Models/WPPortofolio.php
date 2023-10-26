<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WPPortofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_photographer_id',
        'admin_id',
        'judul',
        'tanggal',
        'lokasi',
        'status',
    ];

    public function photo(): HasMany {
        return $this->hasMany(WPPortofolioPhoto::class, 'w_p_portofolio_id');
    }
}
