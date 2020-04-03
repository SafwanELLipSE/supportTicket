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
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createAgent(Request $request)
    {
      $departments = Department::where('is_active',1)->get();
      return view("agents.create_agent",[
        'departments' => $departments
      ]);
    }

    public function saveCreatedAgent(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'name'      => 'required|min:3',
            'email'     => 'required|unique:users,email',
            'mobile_no' => 'required|min:11|max:13',
            'address'   => 'required',
            'password'  => 'required|min:5',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()){
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
          }

          $user = new User();
          $user->name = $request->post('name');
          $user->email = $request->post('email');
          $user->mobile_no = $request->post('mobile_no');
          $user->access_level = User::ACCESS_LEVEL_AGENT;
          $user->password = bcrypt($request->post('password'));
          $user->save();
          if(count($request->post('departments'))){
            foreach ($request->post('departments') as $item) {
              $agents_departments = new Agent_department();
              $agents_departments->user_id = $user->id;
              $agents_departments->department_id = $item;
              $agents_departments->created_by = Auth::user()->id;
              $agents_departments->is_active = Agent_department::ACTIVE;
              $agents_departments->save();
            }
          }

          Alert::success('Success', 'Successfully Created');
          return redirect()->route('agent.create');

    }

    public function GetAgentList(Request $request)
    {
      $agents = User::where('access_level',User::ACCESS_LEVEL_AGENT)->get();
      return view('agents.agent_list',[
        'agents' => $agents
      ]);
    }
  public function createDepartment(Request $request)
  {
    return view("departments.create_department");
  }

  public function saveCreatedDepartment(Request $request)
  {
    $validator = Validator::make($request->all(), [
          'department_name' => 'required|min:3',
          'address'   => 'required',
          'name'      => 'required|min:3',
          'email'     => 'required|unique:users,email',
          'mobile_no' => 'required|min:11|max:13',
          'password'  => 'required|min:5',
          'confirm_password' => 'required|same:password'
      ]);

      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = new User();
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->mobile_no = $request->post('mobile_no');
        $user->access_level = User::ACCESS_LEVEL_DEPARTMENT_ADMIN;
        $user->password = bcrypt($request->post('password'));
        $user->save();

        $department = new Department();
        $department->user_id = $user->id;
        $department->name = $request->post('department_name');
        $department->address = $request->post('address');
        $department->is_active = Department::ACTIVE;
        $department->save();

        if(count($request->post('category'))){
          foreach ($request->post('category') as $item) {
            $dept_ticket_category = new Dept_ticket_category();
            $dept_ticket_category->department_id = $department->id;
            $dept_ticket_category->category = $item;
            $dept_ticket_category->is_active = Dept_ticket_category::ACTIVE;
            $dept_ticket_category->save();
          }
        }

        Alert::success('Success', 'Successfully Created');
        return redirect()->route('department.create');
  }

  public function getDepartmentList(Request $request)
  {
      $departments = Department::where('is_active',1)->get();
      return view('departments.department_list',[
        'departments' => $departments
      ]);
  }

  public function detailDepartment(Request $request,$id)
  {
    $departmentId = Department::find($id)->id;
    $tickets = Ticket::where('department_id',$departmentId)
                      ->orderBy('id','DESC')
                      ->limit(5)
                      ->get();
    $employees = Department_employee::where('department_id',$departmentId)
                      ->orderBy('id','DESC')
                      ->limit(5)
                      ->get();

    return view('departments.detail_department',[
      'department' => Department::find($id),
      'tickets' => $tickets,
      'employees' => $employees,
    ]);
  }

  public function editDepartment(Request $request,$id)
  {
    $departmentId = Department::find($id)->id;
    $tickets = Ticket::where('department_id',$departmentId)->get();
    $employees = Department_employee::where('department_id',$departmentId)->get();
    return view('departments.department_edit',[
      'department' => Department::find($id),
      'tickets' => $tickets,
      'employees' => $employees,
    ]);
  }
  public function updateDepartment(Request $request){

      $validator = Validator::make($request->all(), [
            'department_name' => 'required|min:3',
            'address'   => 'required',
            'user_name' => 'required|min:3',
            'email'     => 'required|unique:users,email',
            'mobile'    => 'required|min:11|max:13',
      ]);

      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
        }

      User::where('active',1)->update([
          'name'     => $request->post('user_name'),
          'email'    => $request->post('email'),
          'mobile_no'=> $request->post('mobile')
      ]);

      Department::where('active',1)->update([
            'name'         => $request->post('department_name'),
            'address'      => $request->post('address')
      ]);

      Alert::success('Success', 'Successfully Updated');
      return redirect()->route('department.detail_department');
  }

}
