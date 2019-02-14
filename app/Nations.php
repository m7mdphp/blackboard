<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nations extends Model
{
	public $timestamps = true;
    protected  $table='nations';
     protected $fillable = [
        'title',
    ];

    public function universtes()
    {
        return $this->belongsTo('App\Universtes');
    }
}
