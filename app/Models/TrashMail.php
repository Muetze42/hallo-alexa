<?php

namespace App\Models;

use NormanHuth\TrashMail\Models\TrashMail as Model;

class TrashMail extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'mysql2';
}
