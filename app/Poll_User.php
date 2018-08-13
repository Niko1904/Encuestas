<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll_User extends Model
{

  protected $fillable = [
      'poll_id', 'user_id',
  ];
  
}
