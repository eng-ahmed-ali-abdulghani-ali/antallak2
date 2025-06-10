<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'trip_id',
        'delivery_item_count',
        'estimated_weight',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'delivery_item_count' => 'integer',
        'estimated_weight' => 'decimal:2',
    ];

    /**
     * Get the trip that this order belongs to.
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
