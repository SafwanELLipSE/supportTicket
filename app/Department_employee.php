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

  public function employeeTicket()
  {
    return $this->hasOne(Department_employee_ticket::class,'dept_employee_id','id');
    // return $this->belongsTo(Department_employee_ticket::class);
  }

  public static function getStatus($active_id){
    switch($active_id) {
            case 0    : return "<span class='text-danger'> Inactive </span>";
            case 1    : return "<span class='text-success'> Active </span>";
        }
  }

}
