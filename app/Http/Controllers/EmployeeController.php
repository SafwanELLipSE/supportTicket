<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use App\Department_employee;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
  public function createEmployee(Request $request)
  {
      $departments = array();
       if( Auth::user()->isMasterAdmin()){
         $departments = Department::where('is_active',1)->get();
       }
       else{
         $userIds = User::where('user_id',Auth::user()->id)->where('is_active',1)->pluck('id');
         $departments = Department::whereIn('id', $userIds)->get();
       }

      return view("employees.create_employee",[
        'departments' => $departments
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

          Alert::success('Success', 'Successfully Created');
          return redirect()->route('employee.create');

  }

  public function getEmployeeList(Request $request)
  {
      $dept_employees = Department_employee::where('is_active',1)->get();
      return view("employees.employee_list",[
        'dept_employees' => $dept_employees
      ]);
  }

  public function detailEmployee(Request $request, $id){
      return view('employees.detail_employee',[
        'employee' => Department_employee::find($id),
      ]);
  }
}
