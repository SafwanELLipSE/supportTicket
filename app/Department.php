<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
  public function ticketCategories(){

    return $this->hasMany(Dept_ticket_category::class);
  }

}
