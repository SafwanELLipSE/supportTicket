<?php

namespace App\Http\Controllers;

use App\Department;
use App\Agent_department;
use Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function createTicket(Request $request)
    {
      if( Auth::user()->isMasterAdmin()){
        $departments = Department::where('is_active',1)->get();
      }
      else{
        $departments = Agent_department::with('department')->where('user_id',Auth::user()->id)->get();

      }

      return view('tickets.create_ticket',[
        'departments' => $departments,
      ]);
    }

    public function getAllTickets(Request $request)
    {
      return view('tickets.create_ticket');
    }

    public function getOpenTickets(Request $request)
    {
      return view('tickets.create_ticket');
    }
    public function getSolvedTickets(Request $request)
    {
      return view('tickets.create_ticket');
    }
    public function getClosedTickets(Request $request)
    {
      return view('tickets.create_ticket');
    }
}
