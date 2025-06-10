<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTranslation extends Model
{
    protected $fillable = ['locale', 'name','service_id'];

    public $timestamps = false;
    protected $hidden = ['created_at', 'updated_at'];
}
