<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PricingRule extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'pricing_rules';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'city_id',
        'category_id',
        'base_fare',
        'cost_per_km',
        'cost_per_minute',
        'minimum_fare',
        'start_time',
        'end_time',
        'days_of_week',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'days_of_week'   => 'array', //  Now Laravel handles it as JSON
        'start_time'     => 'datetime:H:i:s',
        'end_time'       => 'datetime:H:i:s',
        'is_active'      => 'boolean',
        'deleted_at'     => 'datetime',
    ];

    /**
     * Relationship with City model.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Relationship with Category model.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Check if this rule applies to all days.
     */
    public function appliesToAllDays(): bool
    {
        return in_array('all', $this->days_of_week ?? []);
    }

    /**
     * Scope to get pricing rules that apply on a specific day.
     */
    public function scopeAppliesOnDay($query, $day)
    {
        return $query->whereJsonContains('days_of_week', $day);
    }
}
