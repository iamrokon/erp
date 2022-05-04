<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\syouhin2;
use App\syouhin3;

class syouhin1 extends Model
{
    
    
        protected $table = 'syouhin1';
        protected $primaryKey = 'bango';
        public $timestamps = false;
        public $incrementing = true;

        public function syouhin2()
        {
            return syouhin2::where('bango',$this->bango)->first();
        }

        public function syouhin3()
        {
            return syouhin3::where('bango',$this->bango)->first();
        }
    
}
