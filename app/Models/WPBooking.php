<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WPBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id',
        'w_p_plan_id',
        'status',
        'bukti_bayar',
        'tanggal',
    ];
}
