<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
	protected $fillable = ['user_id', 'poll_id', 'from','to','text','total'];

	public function user()
	{
	    return $this->belongsTo('App\User');
	}
}
