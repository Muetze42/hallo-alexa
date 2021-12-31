<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\ClickAll
 *
 * @property int $id
 * @property string $clickable_type
 * @property int $clickable_id
 * @property string $os
 * @property string $client
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read Model|\Eloquent $clickable
 * @method static \Illuminate\Database\Eloquent\Builder|ClickAll newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClickAll newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClickAll query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClickAll whereClickableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClickAll whereClickableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClickAll whereClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClickAll whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClickAll whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClickAll whereOs($value)
 * @mixin \Eloquent
 */
class ClickAll extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'os',
        'client',
    ];

    /**
     * Get the parent clickable model.
     */
    public function clickable(): MorphTo
    {
        return $this->morphTo();
    }
}
