<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Centers;

class Messages extends Model
{
    public $timestamps = true;
    protected  $table='messages';
     protected $fillable = [
        'from_table', 'to_table','from_id', 'to_id', 'title', 'message',
    ];

    public function users_from()
    {
    	return $this->belongsTo('App\User','from_id','id');
    }
     public function users_to()
    {
    	return $this->belongsTo('App\User','to_id','id');
    }


        public function centers_from()
    {
    	return $this->belongsTo('App\Centers','from_id','id');
    }
        public function centers_to()
    {
    	return $this->belongsTo('App\Centers','to_id','id');
    }


        public function students_from()
    {
    	return $this->belongsTo('App\Students','from_id','id');
    }
    public function students_to()
    {
    	return $this->belongsTo('App\Students','to_id','id');
    }



            public function teachers_from()
    {
    	return $this->belongsTo('App\Teachers','from_id','id');
    }
     public function teachers_to()
    {
    	return $this->belongsTo('App\Teachers','to_id','id');
    }

}
