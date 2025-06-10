<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverInfo extends Model
{
    protected $table = 'driver_info';

    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'user_id',
        'supervisor_id',
        'city_id',
        'category_id',
        'brand_id',
        'appearance_status',
        'latitude',
        'longitude',
        'recorded_at',
        'stcpay_number',
        'nationality',
        'date_of_birth',
        'iqama_number',
        'iqama_expiry',
        'driving_license_expiry',
        'under_kafala',
        'vehicle_name',
        'vehicle_model_year',
        'number_plate',
    ];

    /**
     * Attribute type casting for proper data handling
     */
    protected $casts = [
        'appearance_status'        => 'boolean',
        'under_kafala'             => 'boolean',
        'recorded_at'              => 'datetime',
        'iqama_expiry'             => 'date',
        'driving_license_expiry'   => 'date',
        'date_of_birth'            => 'date',
        'vehicle_model_year'       => 'integer',
    ];

    /**
     * Relationship: Each driver info belongs to one user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Each driver may have a supervisor (optional)
     */
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    /**
     * Relationship: Each driver is linked to a city
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Relationship: Each driver belongs to a vehicle category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship: Each driver vehicle is associated with a brand
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
