<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Universtes extends Model
{
    public $timestamps = true;
    protected  $table='universtes';
     protected $fillable = [
        'nation', 'title',
    ];
    public function nations(){
    	return $this->hasOne('App\Nations','id','nation');
    }
    public function colleges()
    {
        return $this->belongsTo('App\Colleges');
    }
     public function orders()
    {
        return $this->belongsTo('App\Orders');
    }
}

