<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WOPortofolioPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_o_portofolio_id',
        'url',
    ];
}
