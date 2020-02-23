<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent_department extends Model
{
  public function department(){
    
    return $this->belongsTo(Department::class);
  }
}
