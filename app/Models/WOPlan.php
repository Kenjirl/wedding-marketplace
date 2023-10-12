<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WOPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_organizer_id',
        'nama',
        'detail_layanan',
        'harga',
    ];
}
