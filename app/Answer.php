<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $fillable = [
        'name', 
        'value', 
        'question_id', 
        'poll_id',
        'group_name'
    ];   

	public function question()
    {
        return $this->belongsTo('App\Question');
    }

    public function poll()
    {
        return $this->belongsTo('App\Poll');
    }


}
