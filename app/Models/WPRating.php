<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WPRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_couple_id',
        'wedding_photographer_id',
        'rating',
        'komentar'
    ];
}
