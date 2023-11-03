<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeddingCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'nama',
        'keterangan',
    ];

    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
