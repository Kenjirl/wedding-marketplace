<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WPPortofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_photographer_id',
        'judul',
        'tanggal',
        'lokasi',
    ];
}
