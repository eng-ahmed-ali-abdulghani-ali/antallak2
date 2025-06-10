<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected $table = 'payment_details';


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'amount',
        'transaction_reference',
        'trip_id',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Get the trip associated with this payment detail.
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
