<?php

namespace App\Http\Controllers;

use App\Charts\TicketChart;
use Carbon\Carbon;
use App\Ticket;
use App\Department;
use App\Agent_department;
use App\Notification;
use App\User;

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
            $today = Ticket::whereDate('created_at', '=',date('Y-m-d'))->count();
            $yesterday = Ticket::whereDate('created_at', '=', date('Y-m-d',strtotime('-1 days')) )->count();
            $lastWeek = Ticket::whereDate('created_at', '>', date('Y-m-d',strtotime('-7 days')) )->count();
            $lastMonth = Ticket::whereDate('created_at', '>', date('Y-m-d',strtotime('-30 days')) )->count();
            $lastSixMonth = Ticket::whereDate('created_at', '>', date('Y-m-d',strtotime('-180 days')) )->count();
            $lastYear = Ticket::whereDate('created_at', '>', date('Y-m-d',strtotime('-365 days')) )->count();

            $recentTicketList = Ticket::whereDate('created_at', '>=', date('Y-m-d',strtotime('-7 days')) )->limit(20)->get();
            $recentDepartment = Department::where('is_active',1)->orderBy('id', 'DESC')->limit(20)->get();

            $totalTicket = Ticket::all()->count();
            $totalClosed = Ticket::where('status',Ticket::CLOSED)->count();
            $totalSolved = Ticket::where('status',Ticket::SOLVED)->count();
            $totalOpen = Ticket::where('status',Ticket::OPEN)->count();

            $todayTicket = Ticket::whereDate('created_at', '=',date('Y-m-d'))->count();
            $todayClosed = Ticket::whereDate('created_at', '=',date('Y-m-d'))->where('status',Ticket::CLOSED)->count();
            $todaySolved = Ticket::whereDate('created_at', '=',date('Y-m-d'))->where('status',Ticket::SOLVED)->count();
            $todayOpen = Ticket::whereDate('created_at', '=',date('Y-m-d'))->where('status',Ticket::OPEN)->count();

            $date = new Carbon;
            $hours = array();
            $count = 0;
            for($i=0; $i<=24;$i++)
            {
                $hours[] = Ticket::whereDate('created_at', '=',date('Y-m-d'))->where('created_at', '>=', $date->subHours($count))->count();
                $count++;
            }


            $solved = Ticket::where('status',Ticket::SOLVED)->orderBy('created_at', 'DESC')->limit(8)->get();

            if(count($solved) < 8)
            {
              $close = Ticket::where('status',Ticket::CLOSED)->orderBy('created_at', 'DESC')->limit(8 - count($solved))->get();
            }
            else
            {
              $close = Ticket::where('status',Ticket::CLOSED)->orderBy('created_at', 'DESC')->limit(0)->get();
            }
            if(count($close) + count($solved)  < 8)
            {
              $open = Ticket::where('status',Ticket::OPEN)->orderBy('created_at', 'DESC')->limit(8 - (count($close) + count($solved)))->get();
            }
            else
            {
              $open = Ticket::where('status',Ticket::OPEN)->orderBy('created_at', 'DESC')->limit(0)->get();
            }
        }
        elseif(Auth::user()->isAgent())
        {
          $agentDepartmentIds = Agent_department::where('user_id',Auth::user()->id)->where('is_active',1)->pluck('department_id');

          $today = Ticket::whereIn('department_id',$agentDepartmentIds)->whereDate('created_at', '=',date('Y-m-d'))->count();
          $yesterday = Ticket::whereIn('department_id',$agentDepartmentIds)->whereDate('created_at', '=', date('Y-m-d',strtotime('-1 days')) )->count();
          $lastWeek = Ticket::whereIn('department_id',$agentDepartmentIds)->whereDate('created_at', '>', date('Y-m-d',strtotime('-7 days')) )->count();
          $lastMonth = Ticket::whereIn('department_id',$agentDepartmentIds)->whereDate('created_at', '>', date('Y-m-d',strtotime('-30 days')) )->count();
          $lastSixMonth = Ticket::whereIn('department_id',$agentDepartmentIds)->whereDate('created_at', '>', date('Y-m-d',strtotime('-180 days')) )->count();
          $lastYear = Ticket::whereIn('department_id',$agentDepartmentIds)->whereDate('created_at', '>', date('Y-m-d',strtotime('-365 days')) )->count();

          $recentTicketList = Ticket::whereIn('department_id',$agentDepartmentIds)->whereDate('created_at', '>=', date('Y-m-d',strtotime('-7 days')) )->limit(20)->get();
          $recentDepartment = Department::whereIn('id',$agentDepartmentIds)->where('is_active',1)->orderBy('id', 'DESC')->limit(20)->get();

          $totalTicket = Ticket::whereIn('department_id',$agentDepartmentIds)->count();
          $totalClosed = Ticket::whereIn('department_id',$agentDepartmentIds)->where('status',Ticket::CLOSED)->count();
          $totalSolved = Ticket::whereIn('department_id',$agentDepartmentIds)->where('status',Ticket::SOLVED)->count();
          $totalOpen = Ticket::whereIn('department_id',$agentDepartmentIds)->where('status',Ticket::OPEN)->count();

          $todayTicket = Ticket::whereIn('department_id',$agentDepartmentIds)->whereDate('created_at', '=',date('Y-m-d'))->count();
          $todayClosed = Ticket::whereIn('department_id',$agentDepartmentIds)->whereDate('created_at', '=',date('Y-m-d'))->where('status',Ticket::CLOSED)->count();
          $todaySolved = Ticket::whereIn('department_id',$agentDepartmentIds)->whereDate('created_at', '=',date('Y-m-d'))->where('status',Ticket::SOLVED)->count();
          $todayOpen = Ticket::whereIn('department_id',$agentDepartmentIds)->whereDate('created_at', '=',date('Y-m-d'))->where('status',Ticket::OPEN)->count();

          $solved = Ticket::whereIn('department_id',$agentDepartmentIds)->where('status',Ticket::SOLVED)->orderBy('created_at', 'DESC')->Limit(8)->get();

          $date = new Carbon;
          $hours = array();
          $count = 0;
          for($i=0;$i<=24;$i++)
          {
              $hours[] = Ticket::whereIn('department_id',$agentDepartmentIds)->whereDate('created_at', '=',date('Y-m-d'))->where('created_at', '>=', $date->subHours($count))->count();
              $count++;
          }

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

            $today = Ticket::whereIn('department_id',$DepartmentIds)->whereDate('created_at', '=',date('Y-m-d'))->count();
            $yesterday = Ticket::whereIn('department_id',$DepartmentIds)->whereDate('created_at', '=', date('Y-m-d',strtotime('-1 days')) )->count();
            $lastWeek = Ticket::whereIn('department_id',$DepartmentIds)->whereDate('created_at', '>', date('Y-m-d',strtotime('-7 days')) )->count();
            $lastMonth = Ticket::whereIn('department_id',$DepartmentIds)->whereDate('created_at', '>', date('Y-m-d',strtotime('-30 days')) )->count();
            $lastSixMonth = Ticket::whereIn('department_id',$DepartmentIds)->whereDate('created_at', '>', date('Y-m-d',strtotime('-180 days')) )->count();
            $lastYear = Ticket::whereIn('department_id',$DepartmentIds)->whereDate('created_at', '>', date('Y-m-d',strtotime('-365 days')) )->count();

            $recentTicketList = Ticket::whereIn('department_id',$DepartmentIds)->whereDate('created_at', '>=', date('Y-m-d',strtotime('-7 days')) )->limit(20)->get();
            $recentDepartment = Department::whereIn('id',$DepartmentIds)->where('is_active',1)->orderBy('id', 'DESC')->limit(20)->get();

            $totalTicket = Ticket::whereIn('department_id',$DepartmentIds)->count();
            $totalClosed = Ticket::whereIn('department_id',$DepartmentIds)->where('status',Ticket::CLOSED)->count();
            $totalSolved = Ticket::whereIn('department_id',$DepartmentIds)->where('status',Ticket::SOLVED)->count();
            $totalOpen = Ticket::whereIn('department_id',$DepartmentIds)->where('status',Ticket::OPEN)->count();

            $todayTicket = Ticket::whereIn('department_id',$DepartmentIds)->whereDate('created_at', '=',date('Y-m-d'))->count();
            $todayClosed = Ticket::whereIn('department_id',$DepartmentIds)->whereDate('created_at', '=',date('Y-m-d'))->where('status',Ticket::CLOSED)->count();
            $todaySolved = Ticket::whereIn('department_id',$DepartmentIds)->whereDate('created_at', '=',date('Y-m-d'))->where('status',Ticket::SOLVED)->count();
            $todayOpen = Ticket::whereIn('department_id',$DepartmentIds)->whereDate('created_at', '=',date('Y-m-d'))->where('status',Ticket::OPEN)->count();

            $open = Ticket::whereIn('department_id',$DepartmentIds)->where('status',Ticket::OPEN)->orderBy('created_at', 'DESC')->Limit(8)->get();

            $date = new Carbon;
            $hours = array();
            $count = 0;
            for($i=0; $i<=24;$i++)
            {
                $hours[] = Ticket::whereIn('department_id',$DepartmentIds)->whereDate('created_at', '=',date('Y-m-d'))->where('created_at', '>=', $date->subHours($count))->count();
                $count++;
            }

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

        if($todayTicket != 0)
        {
          $todayPercentageOfCompleteIssue = ($todayClosed/$todayTicket)*100;
          $todayPercentageOfIncompleteIssue = (($todaySolved+$todayOpen)/$todayTicket)*100;
        }
        else
        {
          $todayPercentageOfCompleteIssue = 0;
          $todayPercentageOfIncompleteIssue = 0;
        }


        $percentageOfCompleteIssue = ($totalClosed/$totalTicket)*100;
        $percentageOfIncompleteIssue = (($totalSolved+$totalOpen)/$totalTicket)*100;


        $chart = new TicketChart;
        $chart->labels(['0','4','8','12','16','20','24']);
        $chart->dataset('Today\'s Ticket','line',$hours)
        ->backgroundColor('rgb(0,0,128,0.7)')->color('rgb(128,0,128,0.8)');


        return view('home',[
          'solved' => $solved,
          'close' => $close,
          'open' => $open,
          'today' => $today,
          'yesterday' => $yesterday,
          'lastWeek' => $lastWeek,
          'lastMonth' => $lastMonth,
          'lastSixMonth' => $lastSixMonth,
          'lastYear' => $lastYear,
          'recentTicketList' => $recentTicketList,
          'recentDepartment' => $recentDepartment,
          'totalTicket' => $totalTicket,
          'totalClosed' => $totalClosed,
          'totalSolved' => $totalSolved,
          'totalOpen' => $totalOpen,
          'todayClosed' => $todayClosed,
          'todaySolved' => $todaySolved,
          'todayOpen' => $todayOpen,
          'todayPercentageOfCompleteIssue' => $todayPercentageOfCompleteIssue,
          'todayPercentageOfIncompleteIssue' => $todayPercentageOfIncompleteIssue,
          'percentageOfCompleteIssue' => $percentageOfCompleteIssue,
          'percentageOfIncompleteIssue' => $percentageOfIncompleteIssue,
          'chart' => $chart,
        ]);
    }


}
