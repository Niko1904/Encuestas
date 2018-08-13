<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterAplication extends Model
{
    protected $fillable = ['start_date','user_id','poll_id', 'status'];

}
