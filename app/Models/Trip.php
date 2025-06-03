<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'trips';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'service_id',
        'client_id',
        'driver_id',
        'payment_method_id',
        'payment_status',
        'category_id',
        'pricing_rule_id',
        'pickup_latitude',
        'pickup_longitude',
        'dropoff_latitude',
        'dropoff_longitude',
        'estimated_duration',
        'total_amount',
        'driver_commission_percent',
        'trip_status',
        'start_time',
        'end_time',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'payment_status' => 'boolean',
        'pickup_latitude' => 'float',
        'pickup_longitude' => 'float',
        'dropoff_latitude' => 'float',
        'dropoff_longitude' => 'float',
        'estimated_duration' => 'integer',
        'total_amount' => 'decimal:2',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the service associated with this trip.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the client user who requested this trip.
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Get the driver assigned to this trip.
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    /**
     * Get the payment method used for this trip.
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Get the vehicle category for this trip.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the pricing rule applied to this trip.
     */
    public function pricingRule()
    {
        return $this->belongsTo(PricingRule::class);
    }

}
