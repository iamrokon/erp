<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class requestTable extends Model
{
    protected $table = 'request';
    public $timestamps = false;

    public $incrementing = false;
}
