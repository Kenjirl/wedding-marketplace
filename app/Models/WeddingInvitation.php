<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingInvitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id',
        'tema',
        'template',
    ];
}
