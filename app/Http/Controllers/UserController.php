<?php

namespace App\Http\Controllers;

use App\Department;
use App\Agent_department;
use App\User;
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

          foreach ($request->post('departments') as $item) {
            $agents_departments = new Agent_department();
            $agents_departments->user_id = $user->id;
            $agents_departments->department_id = $item;
            $agents_departments->created_by = Auth::user()->id;
            $agents_departments->is_active = Agent_department::ACTIVE;
            $agents_departments->save();
          }

          Alert::success('Success', 'Successfully Created');
          return redirect()->route('agent.create');

    }
}
