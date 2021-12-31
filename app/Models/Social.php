<?php

namespace App\Models;

use App\Traits\Model\ActivityLogging;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Social
 *
 * @property string $provider
 * @property string $provider_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static Builder|Social newModelQuery()
 * @method static Builder|Social newQuery()
 * @method static Builder|Social query()
 * @method static Builder|Social whereCreatedAt($value)
 * @method static Builder|Social whereProvider($value)
 * @method static Builder|Social whereProviderId($value)
 * @method static Builder|Social whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string|null $url
 * @method static Builder|Social whereUrl($value)
 * @property-read Collection|Activity[] $activities
 * @property-read int|null $activities_count
 * @property int $id
 * @method static Builder|Social provider(\Illuminate\Database\Eloquent\Builder $query)
 * @method static Builder|Social whereId($value)
 */
class Social extends Model
{
    use HasFactory, ActivityLogging;

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

    /**
     * @param Builder $query
     * @param string $provider
     * @return Model|Builder|null
     */
    public function scopeProvider(Builder $query, string $provider): Model|Builder|null
    {
        return $query->where('provider', $provider)->first();
    }
}
