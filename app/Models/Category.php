<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;


class Category extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;

  protected $fillable = ['name'];
  protected $hidden = ['media'];

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('image')->singleFile();
  }
  public function getImageUrlAttribute()
  {
    return $this->getFirstMediaUrl('image');
  }
  protected $appends = ['image_url'];
}
