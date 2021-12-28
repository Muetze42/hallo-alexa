<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Referrer
 *
 * @property int $id
 * @property int $referrer_host_id
 * @property string|null $url
 * @property string|null $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\ReferrerHost $host
 * @method static \Illuminate\Database\Eloquent\Builder|Referrer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Referrer newQuery()
 * @method static \Illuminate\Database\Query\Builder|Referrer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Referrer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Referrer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referrer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referrer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referrer whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referrer whereReferrerHostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referrer whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|Referrer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Referrer withoutTrashed()
 * @mixin \Eloquent
 */
class Referrer extends Model
{
    use HasFactory, SoftDeletes;

    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'ip',
    ];

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();
        static::created(function ($referrer) {
            $referrer->host->update(['referrer_count' => $referrer->host->referrers->count()]);
        });
    }

    /**
     * Get the host that owns the referrer.
     */
    public function host(): BelongsTo
    {
        return $this->belongsTo(ReferrerHost::class, 'referrer_host_id');
    }
}
