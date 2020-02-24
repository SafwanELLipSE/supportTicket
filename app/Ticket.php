<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
  public static function getPriorityArray(): array
  {
      return [
          'Minor',
          'Major',
          'Critical'
      ];
  }
}
