<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WOPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_organizer_id',
        'nama',
        'harga',
        'status',
    ];

    public function fitur(): HasMany {
        return $this->hasMany(WOPlanDetail::class, 'w_o_plan_id');
    }
}
