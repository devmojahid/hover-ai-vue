<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stripe_plan_id',
        'stripe_product_id',
        'stripe_price',
        'interval',
        'interval_count',
        'trial_period_days',
        'is_active',
        'credits',
    ];
}