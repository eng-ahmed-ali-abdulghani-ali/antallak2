<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate',
        'user_id',
        'trip_id',
    ];

    protected $casts = [
        'rate' => 'integer',
    ];

    /**
     * Get the user who submitted the evaluation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the trip that was evaluated.
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

}
