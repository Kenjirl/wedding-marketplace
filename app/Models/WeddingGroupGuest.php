<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingGroupGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id',
        'nama',
        'link_grup',
        'link',
    ];
}
