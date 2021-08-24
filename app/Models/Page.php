<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

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
}
