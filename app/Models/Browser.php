<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Browser
 *
 * @property int $id
 * @property int $device_type
 * @property int $is_bot
 * @property int $os
 * @property string $browser_name
 * @property string $browser_family
 * @property string $browser_version
 * @property int $browser_version_major
 * @property int $browser_version_minor
 * @property int $browser_version_patch
 * @property string $browser_engine
 * @property string $platform_name
 * @property string $platform_family
 * @property string $platform_version
 * @property int $plattform_version_major
 * @property int $plattform_version_minor
 * @property int $plattform_version_patch
 * @property string|null $device_family
 * @property string|null $device_model
 * @property string|null $mobile_grade
 * @property string|null $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|Browser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Browser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Browser query()
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereBrowserEngine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereBrowserFamily($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereBrowserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereBrowserVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereBrowserVersionMajor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereBrowserVersionMinor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereBrowserVersionPatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereDeviceFamily($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereDeviceModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereDeviceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereIsBot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereMobileGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser whereOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser wherePlatformFamily($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser wherePlatformName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser wherePlatformVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser wherePlattformVersionMajor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser wherePlattformVersionMinor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Browser wherePlattformVersionPatch($value)
 * @mixin \Eloquent
 */
class Browser extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    const DEVICE_TYPE_UNKNOWN = null;
    const DEVICE_TYPE_MOBILE = 1;
    const DEVICE_TYPE_TABLET = 2;
    const DEVICE_TYPE_DESKTOP = 3;

    const OS_UNKNOWN = null;
    const OS_WINDOWS = 1;
    const OS_LINUX = 2;
    const OS_MAC = 3;
    const OS_ANDROID = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_type',
        'is_bot',
        'os',
        'browser_name',
        'browser_family',
        'browser_version',
        'browser_version_major',
        'browser_version_minor',
        'browser_version_patch',
        'browser_engine',
        'platform_name',
        'platform_family',
        'platform_version',
        'plattform_version_major',
        'plattform_version_minor',
        'plattform_version_patch',
        'device_family',
        'device_model',
        'mobile_grade',
        'ip',
    ];
}
