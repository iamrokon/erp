<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class haisou extends Model
{
        protected $table = 'haisou';
        protected $primaryKey = 'bango';
        public $timestamps = false;
        public $incrementing = true;
}
