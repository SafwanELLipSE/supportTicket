<?php

namespace App\Http\Controllers;

use App\Department;
use App\Agent_department;
use App\User;
use App\Ticket;
use App\Dept_ticket_category;
use App\Department_employee;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profileView(Request $request)
    {
        $user = Auth::user();
        $department = Department::where('user_id',$user->id)->first();
        // dd($department);

        $agentDepartmentIds = Agent_department::where('user_id',$user->id)->where('is_active',1)->pluck('department_id');
        $agentDepartments = Department::whereIn('id',$agentDepartmentIds)->get();


        if(Auth::user()->isMasterAdmin())
        {
            $closeTickets = Ticket::where('user_id',$user->id)->where('status',0)
            ->whereDate('created_at', '>', date('Y-m-d',strtotime('-7 days')))
            ->orderBy('id','DESC')
            ->limit(10)
            ->get();

            $openTickets = Ticket::where('user_id',$user->id)->where('status',2)
            ->whereDate('created_at', '>', date('Y-m-d',strtotime('-7 days')))
            ->orderBy('id','DESC')
            ->limit(10)
            ->get();

            $employees = 0;
        }
        elseif(Auth::user()->isAgent())
        {
            $closeTickets = Ticket::where('user_id',$user->id)->where('status',0)
            ->whereDate('created_at', '>', date('Y-m-d',strtotime('-7 days')))
            ->orderBy('id','DESC')
            ->limit(10)
            ->get();
            $openTickets = 0;
            $employees = 0;
        }
        elseif(Auth::user()->canDepartmentAdmin())
        {
            $closeTickets = Ticket::where('department_id',$department->id)->where('status',0)
            ->whereDate('created_at', '>', date('Y-m-d',strtotime('-7 days')))
            ->orderBy('id','DESC')
            ->limit(10)
            ->get();
            $departmentID = Department::where('user_id',$user->id)->pluck('id');
            $employees = Department_employee::where('department_id',$departmentID)
                            ->orderBy('id','DESC')
                            ->limit(10)
                            ->get();

            $openTickets = 0;
        }

        return view('personal.profile',[
          'user' => $user,
          'department' => $department,
          'closeTickets' => $closeTickets,
          'employees' => $employees,
          'agentDepartments' => $agentDepartments,
          'openTickets' => $openTickets,
        ]);
    }
    public function profileEdit(Request $request,$id)
    {
      $user = User::where('id',$id)->first();
      return view('personal.edit',[
        'user' => $user,
      ]);
    }
    public function profileUpdate(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'user_name' => 'required|min:3',
            'email'     => 'required|email',
            'mobile'    => 'required|min:11|max:13',
      ]);

      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
        }

        $userID = $request->post('user_id');
        $departmentID = $request->post('department_id');

        $user = User::find($userID);
        $user->name = $request->post('user_name');
        $user->email = $request->post('email');
        $user->mobile_no = $request->post('mobile');
        $user->save();

        if(Auth::user()->canDepartmentAdmin())
        {
          $department = Department::find($departmentID);
          $department->name = $request->post('department_name');
          $department->address = $request->post('address');
          $department->save();
        }
        Alert::success('Success', 'Successfully Updated');
        return redirect()->back();
    }
}
