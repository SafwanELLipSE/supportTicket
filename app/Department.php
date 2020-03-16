<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
  const ACTIVE = 1;
  const INACTIVE = 0;
  
  public function ticketCategories(){

    return $this->hasMany(Dept_ticket_category::class);
  }

}
