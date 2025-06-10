<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaint extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'trip_id',
        'content',
        'status',
    ];

    /**
     * The user who submitted the complaint.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The trip associated with the complaint.
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    /**
     * Scope to filter complaints by status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
