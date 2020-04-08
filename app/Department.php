<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
  const ACTIVE = 1;
  const INACTIVE = 0;

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function ticketCategories(){

    return $this->hasMany(Dept_ticket_category::class);
  }

  public static function getStatus($active_id){
    switch($active_id) {
      case 0    : return "<span class='text-danger'> Inactive </span>";
      case 1    : return "<span class='text-success'> Active </span>";
        }
  }
}
