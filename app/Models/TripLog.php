<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripLog extends Model
{
    use SoftDeletes;

    // Table name
    protected $table = 'trip_logs';

    /**
     * Attributes that are mass assignable
     */
    protected $fillable = [
        'status',
        'notes',
        'start_log',
        'end_log',
        'trip_id',
        'user_id',
    ];

    /**
     * Attributes type casting for correct data handling
     */
    protected $casts = [
        'start_log' => 'datetime',
        'end_log'   => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relationship: Each trip log belongs to one trip
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    /**
     * Relationship: Each trip log was created by one user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
