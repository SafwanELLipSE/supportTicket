<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

  public function department()
  {
    return $this->belongsTo(Department::class);
  }
  public function ticketCategory(){

    return $this->belongsTo(Dept_ticket_category::class,'id');
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public static function getPriorityArray(): array
  {
      return [
          'Minor',
          'Major',
          'Critical'
      ];
  }
}
