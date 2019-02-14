<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public $timestamps = true;
      protected  $table='orders';
     protected $fillable = [
        'university', 'collage', 'lesson', 'type', 'notes', 'level', 'date', 'howmany', 'number',
    ];
    public function universtes(){
    	return $this->hasOne('App\Universtes','id','university');
    }
    public function colleges(){
    	return $this->hasOne('App\Colleges','id','college');
    }
    public function lessons(){
    	return $this->hasOne('App\Lessons','id','lesson');
    }
}
