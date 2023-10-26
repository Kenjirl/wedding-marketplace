<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WPPortofolioPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_p_portofolio_id',
        'url',
    ];

    public function portofolio(): BelongsTo {
        return $this->belongsTo(WPPortofolio::class, 'w_p_portofolio_id');
    }
}
