<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kjdion84\Laraback\Traits\Timezone;
class Documents extends Model
{
	public $timestamps = true;
  protected $table = 'documents';
  protected $fillable = [
        'university', 'collage', 'year', 'subject', 'diary', 'coast', 'cover', 'center',
    ];
	
	public function center(){
	return $this->hasOne('App\Centers','id','center');
	}
}
