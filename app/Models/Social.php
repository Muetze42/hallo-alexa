<?php

namespace App\Models;

use App\Traits\Model\ActivityLogging;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Social
 *
 * @property string $provider
 * @property string $provider_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Social newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Social newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Social query()
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $url
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereUrl($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read int|null $activities_count
 */
class Social extends Model
{
    use HasFactory, ActivityLogging;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'provider';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider',
        'provider_id',
        'url',
    ];
}
