<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WOCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_organizer_id',
        'wedding_categories_id',
    ];
}
