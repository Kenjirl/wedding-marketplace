<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WCategories extends Model
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

    public function wo_category(): HasMany {
        return $this->hasMany(WOCategories::class, 'w_categories_id');
    }
}
