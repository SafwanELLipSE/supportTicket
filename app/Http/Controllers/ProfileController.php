<?php

namespace App\Http\Controllers;

use App\User;
use App\Department;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profileView(Request $request)
    {
      $user = Auth::user();
      return view('personal.profile',[
        'user' => $user,
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
