<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ReferrerHost
 *
 * @property int $id
 * @property string $name
 * @property int $referrer_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Referrer[] $referrers
 * @property-read int|null $referrers_count
 * @method static \Illuminate\Database\Eloquent\Builder|ReferrerHost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferrerHost newQuery()
 * @method static \Illuminate\Database\Query\Builder|ReferrerHost onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferrerHost query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferrerHost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferrerHost whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferrerHost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferrerHost whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferrerHost whereReferrerCount($value)
 * @method static \Illuminate\Database\Query\Builder|ReferrerHost withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ReferrerHost withoutTrashed()
 * @mixin \Eloquent
 */
class ReferrerHost extends Model
{
    use HasFactory, SoftDeletes;

    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'referrer_count',
    ];

    /**
     * Get the referrers for the host.
     */
    public function referrers(): HasMany
    {
        return $this->hasMany(Referrer::class);
    }
}
