<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\Self_;

class tantousya extends Authenticatable
{
    protected $table = 'tantousya';
    protected $primaryKey = 'bango';
    public $timestamps = false;

    public $incrementing = false;

   /*  public function setAttribute($key, $value)
  {
    $isRememberTokenAttribute = $key == $this->getRememberTokenName();
    if (!$isRememberTokenAttribute)
    {
      parent::setAttribute($key, $value);
    }
  }*/
    public static function innerLevel($bango){
        $innerLevel = self::where('bango',$bango)->first()->innerlevel;
        return $innerLevel;
    }

}
