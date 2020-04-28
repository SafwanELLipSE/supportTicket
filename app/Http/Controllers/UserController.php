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

    public function agentProfile(Request $request, $id){

        $agentId = User::find($id)->id;
        $agentDepartments = Agent_department::where('user_id',$agentId)->where('is_active',1)->get();

        $agentDepartmentIds = Agent_department::where('user_id',$agentId)->pluck('department_id');
        $departments = Department::where('id','!=', $agentDepartmentIds)->where('is_active',1)->get();

        $tickets = Ticket::where('user_id',$agentId)->orderBy('updated_at','DESC')->limit(10)->get();

        $openTickets = Ticket::where('user_id',$agentId)->where('status',Ticket::OPEN)
                                  ->orderBy('updated_at','DESC')
                                  ->limit(10)
                                  ->get();
        $closeTickets = Ticket::where('user_id',$agentId)->where('status',Ticket::CLOSED)
                                  ->orderBy('updated_at','DESC')
                                  ->limit(10)
                                  ->get();


        return view("agents.agent_profile",[
          'agent' => User::find($id),
          'agentDepartments' => $agentDepartments,
          'departments' => $departments,
          'tickets' => $tickets,
          'openTickets' => $openTickets,
          'closeTickets' => $closeTickets,
        ]);
    }

    public function assignDepartmentToEmployee(Request $request){

      $validator = Validator::make($request->all(), [
            'departments'  => 'required',
            'agent_id'     => 'required',
        ]);

        if ($validator->fails()){
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
          }

          $agentId = $request->post('agent_id');
          if(count($request->post('departments'))){
            foreach ($request->post('departments') as $item) {
              $assign_department = new Agent_department();
              $assign_department->user_id = $agentId;
              $assign_department->department_id = $item;
              $assign_department->created_by = Auth::user()->id;
              $assign_department->is_active = Agent_department::ACTIVE;
              $assign_department->save();
            }
          }

          Alert::success('Success', 'Successfully Created');
          return redirect()->route('agent.profile',$agentId);
    }

    public function editAgent(Request $request, $id)
    {
        $agentId = User::find($id)->id;
        $agentDepartments = Agent_department::where('user_id',$agentId)->where('is_active',0)->get();
        return view('agents.agent_edit',[
          'agent' => User::find($id),
          'agentDepartments' => $agentDepartments,
        ]);
    }
    public function updateAgent(Request $request){
      $validator = Validator::make($request->all(), [
            'user_name' => 'required|min:3',
            'email'     => 'required|email',
            'mobile'    => 'required|min:11|max:13',
            'agent_id'  => 'required',
      ]);

      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
        }

         $agentId = $request->post('agent_id');
         $user = User::find($agentId);
         $user->name = $request->post('user_name');
         $user->email = $request->post('email');
         $user->mobile_no = $request->post('mobile');
         $user->save();

      Alert::success('Success', 'Successfully Updated');
      return redirect()->route('agent.edit',$agentId);
    }

    public function inactiveAgentDepartment(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'agent_id'  => 'required',
      ]);

      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
        }

         $agentId = $request->post('agent_id');
         $agentUser = $request->post('agent_user');
         $agentDepartment = Agent_department::find($agentId);
         $agentDepartment->is_active = Agent_department::INACTIVE;
         $agentDepartment->save();

      Alert::success('Success', 'Successfully Updated');
      return redirect()->route('agent.profile',$agentUser);
    }

    public function activeAgentDepartment(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'agent_id'  => 'required',
      ]);

      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
        }

         $agentId = $request->post('agent_id');
         $agentUser = $request->post('agent_user');
         $agentDepartment = Agent_department::find($agentId);
         $agentDepartment->is_active = Agent_department::ACTIVE;
         $agentDepartment->save();

      Alert::success('Success', 'Successfully Updated');
      return redirect()->route('agent.edit',$agentUser);
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
                      ->orderBy('created_at','DESC')
                      ->limit(5)
                      ->get();
    $openTickets = Ticket::where('department_id',$departmentId)->where('status',2)
                      ->limit(5)
                      ->get();
    $employees = Department_employee::where('department_id',$departmentId)
                      ->orderBy('id','DESC')
                      ->limit(5)
                      ->get();

    return view('departments.detail_department',[
      'department' => Department::find($id),
      'tickets' => $tickets,
      'openTickets' => $openTickets,
      'employees' => $employees,
    ]);
  }


  public function addCategoryDepartment(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'category' => 'required',
          'department_id' => 'required',
      ]);
      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
        }

        $departmentId = $request->post('department_id');
        if(count($request->post('category'))){
          foreach ($request->post('category') as $item) {
            $category = new Dept_ticket_category();
            $category->department_id = $departmentId;
            $category->category = $item;
            $category->is_active = Dept_ticket_category::ACTIVE;
            $category->save();
          }
        }

        Alert::success('Success', 'Successfully Created');
        return redirect()->route('department.all_departments');
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
            'department_id' => 'required',
            'department_name' => 'required|min:3',
            'address'   => 'required',
            'user_name' => 'required|min:3',
            'email'     => 'required|email',
            'mobile'    => 'required|min:11|max:13',
      ]);

      if ($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
        }

        $department = Department::find($request->post('department_id'));
        $department->name = $request->post('department_name');
        $department->address = $request->post('address');
        $department->save();

        // do it first
         $userID = Department::find($request->post('department_id'))->user_id;
         $user = User::find($userID);
         $user->name = $request->post('user_name');
         $user->email = $request->post('email');
         $user->mobile_no = $request->post('mobile');
         $user->save();

      Alert::success('Success', 'Successfully Updated');
      return redirect()->route('department.edit',$department->id);
  }


}
