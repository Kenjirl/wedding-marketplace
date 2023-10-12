<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WOPortofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_organizer_id',
        'judul',
        'tanggal',
        'lokasi',
        'lat',
        'long',
    ];
}
