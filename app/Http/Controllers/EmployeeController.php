<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use App\Ticket;
use App\Department_employee;
use App\Department_employee_ticket;
use App\Mail\createEmployee;
use App\Notifications\createEmployeeNotification;
use App\Notifications\editEmployeeNotification;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class EmployeeController extends Controller
{
  public function createEmployee(Request $request)
  {
      $departments = array();
       if( Auth::user()->isMasterAdmin()){
         $departments = Department::where('is_active',1)->get();
       }
       else{
         $departments = Department::where('user_id',Auth::user()->id)->get();
       }

      return view("employees.create_employee",[
        "departments" => $departments,
      ]);
  }

  public function saveCreatedEmployee(Request $request)
  {
      $validator = Validator::make($request->all(), [
            'name'      => 'required|min:3',
            'email'     => 'required|unique:users,email',
            'mobile_no' => 'required|min:11|max:13',
        ]);

        if ($validator->fails()){
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
          }

          $dept_employee = new Department_employee();
          $dept_employee->department_id = $request->post('department');
          $dept_employee->name = $request->post('name');
          $dept_employee->email = $request->post('email');
          $dept_employee->mobile_no = $request->post('mobile_no');
          $dept_employee->is_active = Department_employee::ACTIVE;
          $dept_employee->save();

          if($request->post('example-checkbox1') == 1)
          {
              $toUser = $request->post('email');
              $department_name = Department::where('id',$request->post('department'))->first()->name;
              $name = $request->post('name');

              $details = [
                'title' => $department_name .' Employee('. $request->post('name') .')',
                'body' => 'Welcome! From now on You are one us. we are glad to have you with us',
                'from' =>  Auth::user()->name,
                'department_name' => $department_name,
                'name' => $name,
              ];
              Mail::to($toUser)->send(new createEmployee($details));
          }

          // Notify Admin
          $user1 = User::where('access_level', 'master_admin')->first();
          $user->notify(new createEmployeeNotification($dept_employee->id));
          // Notify Department
          $userDepartment = Department::where('id',$request->post('department'))->pluck('user_id');
          $user2 = User::where('id',$userDepartment)->first();
          $user2->notify(new createEmployeeNotification($dept_employee->id));

          Alert::success('Success', 'Successfully Created');
          return redirect()->route('employee.create');
  }

  public function getEmployeeList(Request $request)
  {
      $dept_employees = array();
      if( Auth::user()->isMasterAdmin()){
         $dept_employees = Department_employee::where('is_active',1)->get();
      }
      else{
         $departmentId = Department::where('user_id',Auth::user()->id)->where('is_active',1)->pluck('id');
         $dept_employees = Department_employee::where('department_id',$departmentId)->get();
      }
      return view("employees.employee_list",[
        "dept_employees" => $dept_employees,
      ]);
  }

  public function detailEmployee(Request $request, $id){
      $employeeId = Department_employee::find($id)->id;
      $ticketIds = Department_employee_ticket::where('dept_employee_id',$employeeId)->where('is_active',1)->pluck('ticket_id');

      $openTickets = Ticket::where('status',Ticket::OPEN)->whereIn('id',$ticketIds)
                      ->orderBy('id','DESC')
                      ->limit(5)
                      ->get();
      $closeTickets = Ticket::where('status',Ticket::CLOSED)->whereIn('id',$ticketIds)
                      ->orderBy('id','DESC')
                      ->limit(5)
                      ->get();

      return view('employees.detail_employee',[
        "employee" => Department_employee::find($id),
        "openTickets" => $openTickets,
        "closeTickets" => $closeTickets,
      ]);
  }

  public function editEmployee(Request $request, $id)
  {
    if( Auth::user()->isMasterAdmin()){
      $departments = Department::where('is_active',1)->get();
    }
    else{
      $departments = Department::where('user_id',Auth::user()->id)->get();
    }

    return view('employees.employee_edit',[
      "employee" => Department_employee::find($id),
      "departments" => $departments,
    ]);
  }

  public function updateEmployee(Request $request){

    $validator = Validator::make($request->all(), [
          'employee_name' => 'required|min:3',
          'employee_id' => 'required',
          'email'     => 'required|unique:users,email',
          'mobile' => 'required|min:11|max:13',
      ]);

      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
        }

        $employeeId = $request->post('employee_id');
        $employee =  Department_employee::find($employeeId);
        $employee->department_id = $request->post('department');
        $employee->name = $request->post('employee_name');
        $employee->email = $request->post('email');
        $employee->mobile_no = $request->post('mobile');
        $employee->save();

        // Notify Admin
        $user1 = User::where('access_level', 'master_admin')->first();
        $user1->notify(new editEmployeeNotification($employeeId));
        // Notify Department
        $userDepartment = Department::where('id',$request->post('department'))->pluck('user_id');
        $user2 = User::where('id',$userDepartment)->first();
        $user2->notify(new createEmployeeNotification($dept_employee->id));


        Alert::success('Success', 'Successfully Created');
        return redirect()->route('employee.edit', $employeeId);
  }
}
