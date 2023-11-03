<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WOPortofolioPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_o_portofolio_id',
        'url',
    ];

    public function portofolio(): BelongsTo {
        return $this->belongsTo(WOPortofolio::class, 'w_o_portofolio_id');
    }
}
