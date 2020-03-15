<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent_department extends Model
{
  const ACTIVE = 1;
  const INACTIVE = 0;

  public function department(){

    return $this->belongsTo(Department::class);
  }
}
