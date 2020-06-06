<?php

namespace Dev\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    protected $guarded = [
        "id"
    ];

    public $timestamps = false;
}