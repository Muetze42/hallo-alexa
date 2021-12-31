<?php

namespace App\Models;

use App\Traits\Model\ActivityLogging;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\Shorten
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Shorten newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shorten newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shorten query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $uri
 * @property string|null $target
 * @property string|null $module
 * @property bool $external
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Shorten whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shorten whereExternal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shorten whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shorten whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shorten whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shorten whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shorten whereUri($value)
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|Shorten whereDescription($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read int|null $activities_count
 */
class Shorten extends Model
{
    use HasFactory, ActivityLogging;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uri',
        'target',
        'module',
        'description',
        'external',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'external' => 'bool',
    ];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted()
    {
        static::saving(function ($shorten) {
            $shorten->uri = Str::slug(trim($shorten->uri), '-', 'de');
        });
    }
}
