<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailAplication extends Model
{
    protected $fillable = ['start','end','value','user_id','poll_id','answer_id'];

}
