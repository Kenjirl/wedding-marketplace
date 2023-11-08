<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WPPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_photographer_id',
        'nama',
        'harga',
        'status',
    ];

    public function fitur(): HasMany {
        return $this->hasMany(WPPlanDetail::class, 'w_p_plan_id');
    }
}
