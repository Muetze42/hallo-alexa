<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Page extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const ROBOTS = [
        0 => 'noindex,nofollow',
        1 => 'noindex,follow',
        2 => 'index,nofollow',
        3 => 'index,follow',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route',
        'title',
        'description',
        'og_title',
        'og_description',
        'robots',
    ];

    /**
     * Defining conversions
     *
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('og')
            ->width(1200)
            ->height(630)
            ->sharpen(100)
            ->nonQueued();
    }

    /**
     * Defining media collections
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('og')
            ->singleFile()
            ->useFallbackUrl(url('img/fallback.jpg'))
            ->useFallbackPath(public_path('/img/fallback.jpg'));
    }
}
