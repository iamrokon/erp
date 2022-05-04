<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'bango';
    public $timestamps = false;

    public $incrementing = false;
}
