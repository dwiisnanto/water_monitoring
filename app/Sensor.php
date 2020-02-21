<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name', 'remark', 'status',
    ];
}
