<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SystemSetting extends Model
{
    use HasFactory;


    protected $table = 'system_settings';


    protected $fillable = [
        'key',
        'value',
        'type',
    ];


    protected $casts = [
        'value' => 'json',
    ];



    public static function getSetting(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function setSetting(string $key, mixed $value, array $extraAttributes = []): static
    {
        return static::updateOrCreate(
            ['key' => $key],
            array_merge(['value' => $value], $extraAttributes)
        );
    }


}
