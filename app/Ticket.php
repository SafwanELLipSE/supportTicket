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

    return $this->hasOne(Dept_ticket_category::class,'id','dept_ticket_category_id');
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
  public static function getTicketPriorityString($priority_id){
    switch($priority_id) {
            case 0    : return 'Minor';
            case 1    : return 'Major';
            case 2    : return 'Critical';
        }
  }
}
