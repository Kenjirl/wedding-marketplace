<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WOBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_invitation_id',
        'w_o_plan_id',
        'status',
        'bukti_bayar',
        'tanggal',
    ];
}
