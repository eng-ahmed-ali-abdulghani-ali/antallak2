<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NationalityTranslation extends Model
{
    protected $fillable = ['locale', 'name','nationality_id'];

    public $timestamps = false;
    protected $hidden = ['created_at', 'updated_at'];
}
