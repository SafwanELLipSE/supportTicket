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
  public static function getStatus($active_id){
    switch($active_id) {
            case 0    : return "<span class='text-danger'> Inactive </span>";
            case 1    : return "<span class='text-success'> Active </span>";
        }
  }
}
