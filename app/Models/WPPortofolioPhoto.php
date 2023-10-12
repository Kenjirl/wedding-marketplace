<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WPPortofolioPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_p_portofolio_id',
        'url',
    ];
}
