<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
	public $timestamps = true;
      protected  $table='lessons';
     protected $fillable = [
        'college', 'title',
    ];
    public function colleges(){
    	return $this->hasOne('App\Colleges','id','college');
    }
     public function orders()
    {
        return $this->belongsTo('App\Orders');
    }
}
