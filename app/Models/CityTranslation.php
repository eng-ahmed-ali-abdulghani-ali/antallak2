<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    protected $fillable = ['locale', 'name','city_id'];

    public $timestamps = false;
    protected $hidden = ['created_at', 'updated_at'];
}
