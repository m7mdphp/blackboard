<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kjdion84\Laraback\Traits\Timezone;
class Blog extends Model
{
	public $timestamps = true;
	protected $table = 'blogs';
    protected $fillable = ['name'];
}
