<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kjdion84\Laraback\Traits\LarabackUser;
use Illuminate\Database\Eloquent\Model;
use Kjdion84\Laraback\Traits\Timezone;

class Teachers extends Authenticatable
{
use Notifiable, LarabackUser;
protected  $table='teachers';
     protected $fillable = [
        'name', 'email', 'password',
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
   return $this->hasOne('App\Messages','from_id','id');
}


    public function to()
{
   return $this->hasOne('App\Messages','to_id','id');
}
}
