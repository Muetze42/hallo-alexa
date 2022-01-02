<?php

namespace App\Models;

use App\Helpers\Sitemap;
use App\Traits\Model\ActivityLogging;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Activitylog\LogOptions;

/**
 * App\Models\Link
 *
 * @property int $id
 * @property int $active
 * @property string $name
 * @property string $target
 * @property string|null $icon
 * @property int $count
 * @property int $real_count
 * @property string $color
 * @property int $order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read Collection|LinkCount[] $counts
 * @property-read int|null $counts_count
 * @property-read Collection|LinkRealCount[] $realCounts
 * @property-read int|null $real_counts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Link newQuery()
 * @method static Builder|Link onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Link ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Link query()
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereRealCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereUpdatedAt($value)
 * @method static Builder|Link withTrashed()
 * @method static Builder|Link withoutTrashed()
 * @mixin Eloquent
 * @property-read Collection|\App\Models\Click[] $clicks
 * @property-read int|null $clicks_count
 * @property-read Collection|\App\Models\ClickAll[] $clicksAll
 * @property-read int|null $clicks_all_count
 */
class Link extends Model implements Sortable
{
    use HasFactory, SoftDeletes, SortableTrait, ActivityLogging;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active',
        'name',
        'target',
        'icon',
        'count',
        'real_count',
        'color',
        'order',
    ];

    /**
     * The sortable settings
     *
     * @var array
     */
    public array $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'active' => true,
    ];

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function booted(): void
    {
        static::created(function () {
            gerateAdditionalStylesheet();
            Artisan::call('sitemap');
        });
        static::updated(function ($link) {
            if ($link->name != $link->getOriginal('name') || $link->target != $link->getOriginal('target')) {
                Page::find(1)->touch();
                Artisan::call('sitemap');
            }
            gerateAdditionalStylesheet();
        });
    }

    /**
     * @return MorphMany
     */
    public function clicks(): MorphMany
    {
        return $this->morphMany(Click::class, 'clickable');
    }

    /**
     * @return MorphMany
     */
    public function clicksAll(): MorphMany
    {
        return $this->morphMany(ClickAll::class, 'clickable');
    }

    /**
     * Get the counts for the link.
     */
    public function counts(): HasMany
    {
        return $this->hasMany(LinkCount::class);
    }

    /**
     * Get the counts for the link.
     */
    public function realCounts(): HasMany
    {
        return $this->hasMany(LinkRealCount::class);
    }
}
