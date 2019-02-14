<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phds extends Model
{
  public $timestamps = false;
     protected  $table='phds';
     protected $fillable = [
        'title',
        'details',
        'pages',
        'alngs',
        'notes',
        'date',
    ];
}
