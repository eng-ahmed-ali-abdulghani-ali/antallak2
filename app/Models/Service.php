<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Astrotomic\Translatable\Translatable;

class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia,Translatable;

    public const COLLECTION_SERVICES_IMAGE = 'servicesImages';


    protected $fillable = ['name'];
    public $translatedAttributes = ['name'];

    public $timestamps = false;

   // protected $hidden = ['name', 'created_at', 'updated_at'];

    /**
     * Register the media collections for the service model.
     */
    public function registerMediaCollections(?Media $media = null): void
    {
        $this->addMediaCollection(self::COLLECTION_SERVICES_IMAGE)->singleFile(); // Ensures only the latest image is kept
    }

}
