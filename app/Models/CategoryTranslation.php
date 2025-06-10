<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $fillable = ['locale', 'name','category_id'];

    public $timestamps = false;
    protected $hidden = ['created_at', 'updated_at'];
}
