<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AplicationPoll extends Model
{
    protected $fillable = ['start','end','value','user_id','poll_id', 'question_id', 
    	'answer_id'];

    public function answer() {
        return $this->belongsTo('App\Answer');
    }
}
