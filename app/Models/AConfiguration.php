<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AConfiguration extends Model
{
    use HasFactory;

    protected $casts = [
        'value' => 'array',
    ];

    protected $guarded = [
        'id'
    ];
}
