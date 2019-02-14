<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colleges extends Model
{
    public $timestamps = true;
       protected  $table='colleges';
     protected $fillable = [
        'universty', 'title',
    ];
    public function universtes(){
    	return $this->hasOne('App\Universtes','id','universty');
    }
    public function lessons()
    {
        return $this->belongsTo('App\Lessons');
    }
    public function orders()
    {
        return $this->belongsTo('App\Orders');
    }
}
