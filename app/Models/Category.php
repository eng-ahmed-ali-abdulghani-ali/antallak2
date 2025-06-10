<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Category extends Model implements HasMedia
{
  use HasFactory, Translatable, InteractsWithMedia;

  protected $fillable = ['name'];
  public $translatedAttributes = ['name'];

  public $timestamps = false;

  public const COLLECTION_CATEGORIES_IMAGE = 'CategoriesImages';



  public function registerMediaCollections(?Media $media = null): void
  {
    $this->addMediaCollection(self::COLLECTION_CATEGORIES_IMAGE)->singleFile(); // Ensures only the latest image is kept
  }
}
