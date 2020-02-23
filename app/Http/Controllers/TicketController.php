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

       $departments = array();
      if( Auth::user()->isMasterAdmin()){
        $departments = Department::where('is_active',1)->get();
      }
      else{
        $agentDepartmentIds = Agent_department::where('user_id',Auth::user()->id)->where('is_active',1)->pluck('department_id');
        $departments = Department::whereIn('id', $agentDepartmentIds)->get();

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
