<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kengen extends Model
{
    protected $table = 'kengensettei';
    //protected $primaryKey = ['kengenchar03','kengenchar02'];
    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'kengenchar01','kengenchar02','kengenchar03','kengenchar04','kengenchar05','kengenchar06','kengenchar07','kengenchar08','kengendate01','kengendate02','kengendate03','kengenint01','kengenint02','kengenint03','kengenint04','kengenint05','kengenint06','kengenint07','kengenint08','kengenint09','kengenint10',
    ];

}
