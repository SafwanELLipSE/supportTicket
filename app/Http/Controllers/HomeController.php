<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Department;
use App\Agent_department;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      if(Auth::user()->isMasterAdmin())
        {
            $solved = Ticket::where('status',Ticket::SOLVED)->orderBy('created_at', 'DESC')->Limit(8)->get();

            if(count($solved) < 8)
            {
              $close = Ticket::where('status',Ticket::CLOSED)->orderBy('created_at', 'DESC')->Limit(8 - count($solved))->get();
            }
            else
            {
              $close = Ticket::where('status',Ticket::CLOSED)->orderBy('created_at', 'DESC')->Limit(0)->get();
            }
            if(count($close) + count($solved)  < 8)
            {
              $open = Ticket::where('status',Ticket::OPEN)->orderBy('created_at', 'DESC')->Limit(8 - (count($close) + count($solved)))->get();
            }
            else
            {
              $open = Ticket::where('status',Ticket::OPEN)->orderBy('created_at', 'DESC')->Limit(0)->get();
            }
        }
        elseif(Auth::user()->isAgent())
        {
          $agentDepartmentIds = Agent_department::where('user_id',Auth::user()->id)->where('is_active',1)->pluck('department_id');
          $solved = Ticket::whereIn('department_id',$agentDepartmentIds)->where('status',Ticket::SOLVED)->orderBy('created_at', 'DESC')->Limit(8)->get();

          if(count($solved) < 8)
          {
            $close = Ticket::whereIn('department_id',$agentDepartmentIds)->where('status',Ticket::CLOSED)->orderBy('created_at', 'DESC')->Limit(8 - count($solved))->get();
          }
          else
          {
            $close = Ticket::whereIn('department_id',$agentDepartmentIds)->where('status',Ticket::CLOSED)->orderBy('created_at', 'DESC')->Limit(0)->get();
          }
          if(count($close) + count($solved)  < 8)
          {
            $open = Ticket::whereIn('department_id',$agentDepartmentIds)->where('status',Ticket::OPEN)->orderBy('created_at', 'DESC')->Limit(8 - (count($close) + count($solved)))->get();
          }
          else
          {
            $open = Ticket::whereIn('department_id',$agentDepartmentIds)->where('status',Ticket::OPEN)->orderBy('created_at', 'DESC')->Limit(0)->get();
          }
        }
        elseif(Auth::user()->canDepartmentAdmin())
        {
            $DepartmentIds = Department::where('user_id',Auth::user()->id)->where('is_active',1)->pluck('id');
            $open = Ticket::whereIn('department_id',$DepartmentIds)->where('status',Ticket::OPEN)->orderBy('created_at', 'DESC')->Limit(8)->get();

            if(count($open) < 8)
            {
              $solved = Ticket::whereIn('department_id',$DepartmentIds)->where('status',Ticket::SOLVED)->orderBy('created_at', 'DESC')->Limit(8 - count($open))->get();
            }
            else
            {
              $solved = Ticket::whereIn('department_id',$DepartmentIds)->where('status',Ticket::SOLVED)->orderBy('created_at', 'DESC')->Limit(0)->get();
            }
            if(count($open) + count($solved)  < 8)
            {
              $close = Ticket::whereIn('department_id',$DepartmentIds)->where('status',Ticket::CLOSED)->orderBy('created_at', 'DESC')->Limit(8 - (count($open) + count($solved)))->get();
            }
            else
            {
              $close = Ticket::whereIn('department_id',$DepartmentIds)->where('status',Ticket::CLOSED)->orderBy('created_at', 'DESC')->Limit(0)->get();
            }
        }

        return view('home',[
          'solved' => $solved,
          'close' => $close,
          'open' => $open,
        ]);
    }
}
