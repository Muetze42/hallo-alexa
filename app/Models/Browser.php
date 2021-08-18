<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Browser extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    const DEVICE_TYPE_UNKNOWN = null;
    const DEVICE_TYPE_MOBILE = 1;
    const DEVICE_TYPE_TABLET = 2;
    const DEVICE_TYPE_DESKTOP = 3;

    const OS_UNKNOWN = null;
    const OS_WINDOWS = 1;
    const OS_LINUX = 2;
    const OS_MAC = 3;
    const OS_ANDROID = 4;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
