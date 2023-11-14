<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WOCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_organizer_id',
        'w_categories_id',
    ];

    public function w_organizer(): BelongsTo {
        return $this->belongsTo(WOrganizer::class, 'w_organizer_id');
    }

    public function w_categories(): BelongsTo {
        return $this->belongsTo(WCategories::class, 'w_categories_id');
    }
}
