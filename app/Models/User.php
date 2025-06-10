<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Builder;

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

    public function infoDriver()
    {
        return $this->hasOne(DriverInfo::class, 'user_id');
    }


    public function scopeNearbyDrivers(Builder $query, float $pickup_lat, float $pickup_lng)
    {

        // Define average driving speed in km/h (used to estimate duration)
        $average_speed_kmh = 40; // Adjust as needed for realistic trip duration

        // Define search radius in kilometers (drivers within this range will be returned)
        $radius_km = 50;

        // Haversine formula to calculate the distance (in kilometers) between two coordinates
        $haversine = '(6371 * acos(
                        cos(radians(?)) *
                        cos(radians(driver_info.latitude)) *
                        cos(radians(driver_info.longitude) - radians(?)) +
                        sin(radians(?)) *
                        sin(radians(driver_info.latitude))
                    ))';

        // Build the query to get nearby drivers
        return $query
            // Join driver_info table to access coordinates (latitude, longitude)
            ->join('driver_info', 'users.id', '=', 'driver_info.user_id')

            // Filter only active drivers
            ->where('users.role', self::ROLE_DRIVER)
            ->where('users.is_active', true)

            // Filter drivers within the specified radius using the Haversine formula
            ->whereRaw("$haversine < ?", [$pickup_lat, $pickup_lng, $pickup_lat, $radius_km])

            // Select user info and driver coordinates
            ->select('users.*', 'driver_info.latitude', 'driver_info.longitude')

            // Add calculated distance (in km) to the result set
            ->selectRaw("$haversine AS distance", [$pickup_lat, $pickup_lng, $pickup_lat])

            // Add estimated duration (in minutes) to the result set
            // Formula: duration = (60 * distance) / average_speed
            ->selectRaw("(60 * $haversine / ?) AS estimated_duration", [$pickup_lat, $pickup_lng, $pickup_lat, $average_speed_kmh])

            // Sort results by nearest driver
            ->orderBy('distance');


    }


}
