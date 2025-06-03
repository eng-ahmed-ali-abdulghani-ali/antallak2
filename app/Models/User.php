<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property string $role
 * @property string $name
 * @property string $phone
 * @property \Carbon\Carbon|null $phone_verified_at
 * @property bool $is_active
 */
class User extends Authenticatable implements HasMedia
{

    use HasFactory, Notifiable, InteractsWithMedia, HasApiTokens;

    // Roles constants (optional, for cleaner code)
    public const ROLE_ADMIN = 'admin';
    public const ROLE_CLIENT = 'client';
    public const ROLE_DRIVER = 'driver';
    public const ROLE_SUPERVISOR = 'supervisor';
    public const COLLECTION_USER_IMAGE = 'userImage';


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'phone', 'phone_verified_at', 'role', 'is_active', 'password'];

    /**
     * The attributes that should be hidden for arrays (e.g., JSON responses).
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = ['phone_verified_at' => 'datetime', 'is_active' => 'boolean'];

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Check if user is driver.
     */
    public function isDriver(): bool
    {
        return $this->role === self::ROLE_DRIVER;
    }

    /**
     * Check if user is client.
     */
    public function isClient(): bool
    {
        return $this->role === self::ROLE_CLIENT;
    }

    /**
     * Check if user is supervisor.
     */
    public function isSupervisor(): bool
    {
        return $this->role === self::ROLE_SUPERVISOR;
    }

    /**
     * Register the media collections for the User model.
     */
    public function registerMediaCollections(?Media $media = null): void
    {
        $this->addMediaCollection(self::COLLECTION_USER_IMAGE)->singleFile(); // Ensures only the latest image is kept
    }

}
