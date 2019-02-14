<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Researches extends Model
{
	public $timestamps = false;
     protected  $table='researches';
     protected $fillable = [
        'title',
        'details',
        'pages',
        'alngs',
        'notes',
        'date',
    ];
}
