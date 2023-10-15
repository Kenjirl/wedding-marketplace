<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WOBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_couple_id',
        'wedding_organizer_id',
        'status',
        'bukti_bayar',
        'tanggal',
    ];
}
