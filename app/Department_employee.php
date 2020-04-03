<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department_employee extends Model
{
  const ACTIVE = 1;
  const INACTIVE = 0;

  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public static function getStatus($active_id){
    switch($active_id) {
            case 0    : return "<p class='text-danger'> Inactive </p>";
            case 1    : return "<p class='text-success'> Active </p>";
        }
  }

}
