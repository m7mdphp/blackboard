<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kjdion84\Laraback\Traits\LarabackUser;
use Kjdion84\Laraback\Traits\Timezone;
class User extends Authenticatable
{
    use Notifiable, LarabackUser, Timezone;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','timezone',
    ];
public $timestamps = true;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function from()
{
   return $this->hasMany('App\Messages','from_id','id');
}


    public function to()
{
   return $this->hasMany('App\Messages','to_id','id');
}


}
