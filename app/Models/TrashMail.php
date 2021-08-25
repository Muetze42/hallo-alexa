<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use NormanHuth\TrashMail\Models\TrashMail as Model;

class TrashMail extends Model
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'mysql2';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
