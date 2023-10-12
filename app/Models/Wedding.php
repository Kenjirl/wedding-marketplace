<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_couple_id',
        'groom',
        'bride',
        'waktu_pemberkatan',
        'waktu_perayaan',
        'lokasi_pemberkatan',
        'lokasi_perayaan',
    ];
}
