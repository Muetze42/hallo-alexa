<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Click
 *
 * @property-read Model|\Eloquent $clickable
 * @method static \Illuminate\Database\Eloquent\Builder|Click newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Click newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Click query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $clickable_type
 * @property int $clickable_id
 * @property string $os
 * @property string $client
 * @property string|null $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|Click whereClickableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Click whereClickableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Click whereClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Click whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Click whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Click whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Click whereOs($value)
 */
class Click extends Model
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
        'ip',
    ];

    /**
     * Get the parent clickable model.
     */
    public function clickable(): MorphTo
    {
        return $this->morphTo();
    }
}
