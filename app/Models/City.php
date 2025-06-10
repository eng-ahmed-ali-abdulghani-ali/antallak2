<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class City extends Model
{
    use HasFactory,Translatable;
    protected $fillable = ['name'];
    public $translatedAttributes = ['name'];
    public $timestamps = false;

}
