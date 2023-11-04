<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WOCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_organizer_id',
        'wedding_categories_id',
    ];

    public function w_organizer(): BelongsTo {
        return $this->belongsTo(WeddingOrganizer::class, 'wedding_organizer_id');
    }

    public function w_categories(): BelongsTo {
        return $this->belongsTo(WeddingCategories::class, 'wedding_categories_id');
    }
}
