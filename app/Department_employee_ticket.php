<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department_employee_ticket extends Model
{
    const ACTIVE = 1;
    const INACTIVE = 0;

    public function employee(){
      return $this->hasOne(Department_employee::class,'id','dept_employee_id');
    }
    public static function getStatus($active_id){
      switch($active_id) {
              case 0    : return "<span class='text-danger'> Inactive </span>";
              case 1    : return "<span class='text-success'> Active </span>";
          }
    }
}
