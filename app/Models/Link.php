<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Link extends Model implements Sortable
{
    use HasFactory, SoftDeletes, SortableTrait;

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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'redirect_route',
    ];

    /**
     * Get the redirect route of this link
     *
     * @return string
     */
    public function getRedirectRouteAttribute(): string
    {
        return route('link.redirect', $this->id);
    }

    /**
     * Get the memories for the link.
     */
    public function memories(): HasMany
    {
        return $this->hasMany(LinkMemory::class);
    }

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();
        static::saved(function ($link) {
            gerateAdditionalStylesheet();
        });
    }
}
