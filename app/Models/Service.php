<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Service extends Model implements HasMedia
{
  use InteractsWithMedia, HasFactory;
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
