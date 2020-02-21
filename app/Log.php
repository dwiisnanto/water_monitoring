<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'tstamp', 'value', 'tag_name',
    ];
}
