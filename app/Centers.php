<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kjdion84\Laraback\Traits\LarabackUser;
use Illuminate\Database\Eloquent\Model;
use Kjdion84\Laraback\Traits\Timezone;

class Centers extends Authenticatable
{
    use Notifiable, LarabackUser;
protected  $table='centers';
     protected $fillable = [
        'name', 'email', 'password',
    ];
	
	
	public $timestamps = true;
	protected $hidden = [
        'password', 'remember_token',
    ];


    public function messages_from()
{
   return $this->hasMany('App\Messages','from_id','id');
}


    public function messages_to()
{
   return $this->hasMany('App\Messages','to_id','id');
}
}
