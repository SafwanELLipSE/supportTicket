<?php

namespace App\Http\Controllers;

use App\Department;
use App\Agent_department;
use App\Ticket;
use App\User;
use App\Ticket_comment;
use App\Department_employee;
use App\Department_employee_ticket;
use App\Mail\assignTicket;
use App\Notifications\TicketCreateNotification;
use App\Notifications\AssignTicketNotification;
use App\Notifications\ReassignTicketNotification;
use App\Notifications\SolveTicketNotification;
use App\Notifications\CloseTicketNotification;
use App\Notifications\ActiveEmpolyeeTicketNotification;
use App\Notifications\InactiveEmpolyeeTicketNotification;
use App\Notifications\TicketCommentsNotification;
use App\Notifications\deleteTicketFileNotification;
use App\Notifications\deleteTicketImageNotification;
use App\Notifications\editTicketFileNotification;
use App\Notifications\editTicketImageNotification;
use App\Notifications\uploadNewTicketImageNotification;
use App\Notifications\uploadNewTicketFileNotification;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class TicketController extends Controller
{
    public function uploadNewTicketImage(Request $request)
    {
          $ticketId = $request->post('ticket_id');
          $getTicket = Ticket::where('id',$ticketId)->first();
          $images = $getTicket->img_urls;
          $arrayOfImageFiles = explode(',',$images);

          $newArray = array();

          if($request->imagesToUpload)
          {
              $countImage = count($arrayOfImageFiles);
              foreach($request->imagesToUpload  as $image)
              {
                  $name = Auth::user()->id.'_'.self::uniqueString().++$countImage.'.'.$image->extension();
                  $image->move(public_path('ticket_images'), $name);
                  $newArray[] = $name;
              }
          }

          if($images == 0)
          {
              $newLink = implode(",", $newArray);
          }
          else
          {
              $newLink = $images.','.implode(",", $newArray);
          }

          $addTicket = Ticket::find($ticketId);
          $addTicket->img_urls = $newLink;
          $addTicket->save();

          // Notify admin
          $user1 = User::where('access_level', 'master_admin')->first();
          $user1->notify(new uploadNewTicketImageNotification($ticketId));

          // Notify Department
          $getUserDpt = Department::where('id',$getTicket->department_id)->pluck('user_id');
          $user2 = User::where('id',$getUserDpt)->first();
          $user2->notify(new uploadNewTicketImageNotification($ticketId));

          // Notify Agent
          $user3 = User::where('id',$getTicket->user_id)->first();
          $user3->notify(new uploadNewTicketImageNotification($ticketId));


          Alert::success('Success', 'Successfully, New Images has been Uploaded');
          return redirect()->back();
    }
    public function uploadNewTicketFile(Request $request)
    {
          $ticketId = $request->post('ticket_id');
          $getTicket = Ticket::where('id',$ticketId)->first();
          $files = $getTicket->file_urls;
          $arrayOfFiles = explode(',',$files);

          $newArray = array();

          if($request->filesToUpload)
          {
              $countFile = count($arrayOfFiles);
              foreach($request->filesToUpload  as $file)
              {
                  $name = Auth::user()->id.'_'.self::uniqueString().++$countFile.'.'.$file->extension();
                  $file->move(public_path('ticket_images'), $name);
                  $newArray[] = $name;
              }
          }

          if($files == 0)
          {
              $newLink = implode(",", $newArray);
          }
          else
          {
              $newLink = $files.','.implode(",", $newArray);
          }


          $addTicket = Ticket::find($ticketId);
          $addTicket->file_urls = $newLink;
          $addTicket->save();

          // Notify admin
          $user1 = User::where('access_level', 'master_admin')->first();
          $user1->notify(new uploadNewTicketFileNotification($ticketId));

          // Notify Department
          $getUserDpt = Department::where('id',$getTicket->department_id)->pluck('user_id');
          $user2 = User::where('id',$getUserDpt)->first();
          $user2->notify(new uploadNewTicketFileNotification($ticketId));

          // Notify Agent
          $user3 = User::where('id',$getTicket->user_id)->first();
          $user3->notify(new uploadNewTicketFileNotification($ticketId));

          Alert::success('Success', 'Successfully, New Files has been Uploaded');
          return redirect()->back();
    }
    public function editTicketImage(Request $request)
    {
        $ticketId = $request->post('ticket_id');
        $imageLink = $request->post('image_name');
        $originalName = explode('.',$imageLink);

        $getTicket = Ticket::where('id',$ticketId)->first();
        $images = $getTicket->img_urls;
        $arrayOfImageFiles = explode(',',$images);

        $newArray = array();

        foreach ($arrayOfImageFiles as $image)
        {
          if($image == $imageLink)
          {
            $path_image = public_path(). '/ticket_images/'. $imageLink;
            if(file_exists($path_image) == true)
            {
                unlink($path_image);
            }
            if($request->imageToUpload)
            {
              $uploadImage = $request->imageToUpload;
              $name = $originalName[0].'.'.$uploadImage->getClientOriginalExtension();
              $uploadImage->move(public_path('ticket_images'), $name);
              $newArray[] = $name;
              continue;
            }
          }
          $newArray[] = $image;
        }

        $currentArray = implode(",", $newArray);

        $addTicket = Ticket::find($ticketId);
        $addTicket->img_urls = $currentArray;
        $addTicket->save();

        // Notify admin
        $user1 = User::where('access_level', 'master_admin')->first();
        $user1->notify(new editTicketImageNotification($ticketId,$imageLink,$name));

        // Notify Department
        $getUserDpt = Department::where('id',$getTicket->department_id)->pluck('user_id');
        $user2 = User::where('id',$getUserDpt)->first();
        $user2->notify(new editTicketImageNotification($ticketId,$imageLink,$name));

        // Notify Agent
        $user3 = User::where('id',$getTicket->user_id)->first();
        $user3->notify(new editTicketImageNotification($ticketId,$imageLink,$name));

      Alert::success('Success', 'Successfully, Image has been edited');
      return redirect()->back();
    }
    public function editTicketFile(Request $request)
    {
        $ticketId = $request->post('ticket_id');
        $fileLink = $request->post('file_name');
        $originalName = explode('.',$fileLink);

        $getTicket = Ticket::where('id',$ticketId)->first();
        $files = $getTicket->file_urls;
        $arrayOfFiles = explode(',',$files);

        foreach ($arrayOfFiles as $file)
        {
          if($file == $fileLink)
          {
            $path_file = public_path(). '/ticket_files/'. $fileLink;
            if(file_exists($path_file) == true)
            {
                unlink($path_file);
            }
            if($request->fileToUpload)
            {
              $uploadFile = $request->fileToUpload;
              $name = $originalName[0] .'.'. $uploadFile->getClientOriginalExtension();
              $uploadFile->move(public_path('ticket_files'), $name);
              $newArray[] = $name;
              continue;
            }
          }
          $newArray[] = $file;
        }
        $currentArray = implode(",", $newArray);

        $addTicket = Ticket::find($ticketId);
        $addTicket->file_urls = $currentArray;
        $addTicket->save();

        // Notify admin
        $user1 = User::where('access_level', 'master_admin')->first();
        $user1->notify(new editTicketFileNotification($ticketId,$fileLink,$name));

        // Notify Department
        $getUserDpt = Department::where('id',$getTicket->department_id)->pluck('user_id');
        $user2 = User::where('id',$getUserDpt)->first();
        $user2->notify(new editTicketFileNotification($ticketId,$fileLink,$name));

        // Notify Agent
        $user3 = User::where('id',$getTicket->user_id)->first();
        $user3->notify(new editTicketFileNotification($ticketId,$fileLink,$name));

      Alert::success('Success', 'Successfully, File has been edited');
      return redirect()->back();

    }
    public function deleteTicketImage(Request $request)
    {
        $ticketId = $request->post('ticket_id');
        $imageLink = $request->post('image_name');

        $getTicket = Ticket::where('id',$ticketId)->first();
        $images = $getTicket->img_urls;
        $arrayOfImageFiles = explode(',',$images);

        $newArray = array();

        foreach ($arrayOfImageFiles as $image)
        {
          if($image == $imageLink)
          {
            $path_image = public_path(). '/ticket_images/'. $imageLink;
            unlink($path_image);
            continue;
          }
          $newArray[] = $image;
        }

        $currentArray = implode(",", $newArray);

        $addTicket = Ticket::find($ticketId);
        $addTicket->img_urls = $currentArray;
        $addTicket->save();

        // Notify admin
        $user1 = User::where('access_level', 'master_admin')->first();
        $user1->notify(new deleteTicketImageNotification($ticketId,$imageLink));

        // Notify Department
        $getUserDpt = Department::where('id',$getTicket->department_id)->pluck('user_id');
        $user2 = User::where('id',$getUserDpt)->first();
        $user2->notify(new deleteTicketImageNotification($ticketId,$imageLink));

        // Notify Agent
        $user3 = User::where('id',$getTicket->user_id)->first();
        $user3->notify(new deleteTicketImageNotification($ticketId,$imageLink));

      Alert::success('Success', 'Successfully, Image has been removed');
      return redirect()->back();

    }
    public function deleteTicketFile(Request $request)
    {
        $ticketId = $request->post('ticket_id');
        $fileLink = $request->post('file_name');

        $getTicket = Ticket::where('id',$ticketId)->first();
        $files = $getTicket->file_urls;
        $arrayOfFiles = explode(',',$files);

        $newArray = array();

        foreach ($arrayOfFiles as $file)
        {
          if($file == $fileLink)
          {
            $path_file = public_path(). '/ticket_files/'. $fileLink;
            unlink($path_file);
            continue;
          }
          $newArray[] = $file;
        }

        $currentArray = implode(",", $newArray);

        $addTicket = Ticket::find($ticketId);
        $addTicket->file_urls = $currentArray;
        $addTicket->save();

        // Notify admin
        $user1 = User::where('access_level', 'master_admin')->first();
        $user1->notify(new deleteTicketFileNotification($ticketId,$fileLink));

        // Notify Department
        $getUserDpt = Department::where('id',$getTicket->department_id)->pluck('user_id');
        $user2 = User::where('id',$getUserDpt)->first();
        $user2->notify(new deleteTicketFileNotification($ticketId,$fileLink));

        // Notify Agent
        $user3 = User::where('id',$getTicket->user_id)->first();
        $user3->notify(new deleteTicketFileNotification($ticketId,$fileLink));

        Alert::success('Success', 'Successfully, File has been removed');
        return redirect()->back();
    }

    public function downloadUploadFile(Request $request)
    {
        $file = $request->post('file_name');
        $path = public_path(). '/ticket_files/'. $file;
        return response()->download($path);
    }
    public function displayUploadedFile(Request $request, $id){

        $ticketId = Ticket::find($id)->id;
        $get_ticket = Ticket::where('id',$ticketId)->first();

        $images = $get_ticket->img_urls;
        $arrayOfImageFiles = explode(',',$images);
        $files = $get_ticket->file_urls;
        $arrayOfFiles = explode(',',$files);

        return view('tickets.ticket_internal_files',[
            'arrayOfImageFiles' => $arrayOfImageFiles,
            'arrayOfFiles' => $arrayOfFiles,
            'ticketID' => $ticketId,
        ]);
    }

    public function assignTicket(Request $request)
    {
        $validator = Validator::make($request->all(), [
              'employees' => 'required',
              'ticket_id' => 'required',
        ]);

        if ($validator->fails()){
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
          }

          $ticketId = $request->post('ticket_id');
          $employeeIds = $request->post('employees');

          if(count($employeeIds))
          {
            foreach ($employeeIds as $item)
            {
                  $assign_ticket = new Department_employee_ticket();
                  $assign_ticket->ticket_id = $ticketId;
                  $assign_ticket->dept_employee_id = $item;
                  $assign_ticket->created_by = Auth::user()->id;
                  $assign_ticket->is_active = Department_employee_ticket::ACTIVE;
                  $assign_ticket->save();
              }
          }

          $get_employee_email = Department_employee::where('is_active',1)->whereIn('id',$employeeIds)->pluck('email');
          foreach ($get_employee_email as $item){
              Mail::to($item)->send(new assignTicket($ticketId));
          }

          // Notify admin
          $user1 = User::where('access_level', 'master_admin')->first();
          $user1->notify(new AssignTicketNotification($ticketId));

          // Notify agent
          $getTicketUser = Ticket::where('id',$request->post('ticket_id'))->pluck('user_id');
          $user2 = User::where('id',$getTicketUser)->first();
          $user2->notify(new AssignTicketNotification($ticketId));

          Alert::success('Success', 'Successfully Created');
          return redirect()->route('ticket.display',$ticketId);
    }

    public function saveCommentsOnTicket(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
              'comments'  => 'required|min:3',
          ]);

        if($validator->fails()){
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
          }

          $comments = new Ticket_comment();
          $comments->user_id = Auth::user()->id;
          $comments->ticket_id = Ticket::find($id)->id;
          $comments->comment = $request->post('comments');
          $comments->save();

          // Notify admin
          $user1 = User::where('access_level', 'master_admin')->first();
          $user1->notify(new TicketCommentsNotification($comments->id));

          $getTicketUser = Ticket::where('id',$id)->pluck('user_id');
          $getTicketDepartment = Ticket::where('id',$id)->pluck('department_id');

          if(Auth::user()->canDepartmentAdmin())
          {
              // Notify Agent
              $user2 = User::where('id',$getTicketUser)->first();
              $user2->notify(new TicketCommentsNotification($comments->id));
          }

          if(Auth::user()->isAgent())
          {
              // Notify Department
              $getDepartmentUser = Department::where('id',$getTicketDepartment)->pluck('user_id');
              $user3 = User::where('id',$getDepartmentUser)->first();
              $user->notify(new TicketCommentsNotification($comments->id));
          }

          Alert::success('Success', 'successfully added');
          return redirect()->route('ticket.display',$comments->ticket_id);
    }

    public function displayTicket(Request $request,$id)
    {
      $ticketId = Ticket::find($id)->id;
      $comments = Ticket_comment::where('ticket_id',$ticketId)->paginate(3);
      $departmentId = Ticket::find($id)->department_id;
      $deptEmployeeId = array();
      $deptEmployeeIds = Department_employee_ticket::where('ticket_id',$ticketId)->pluck('dept_employee_id');

      $employees = Department_employee::where('department_id',$departmentId)->where(function($q) use ($deptEmployeeIds) {
          foreach ($deptEmployeeIds as $deptEmployeeId) {
              $q->where('id','!=',$deptEmployeeId);
          }
      })->get();

      $departmentEmployeeTickets = Department_employee_ticket::where('ticket_id',$ticketId)->get();

       $departments = array();
       if( Auth::user()->isMasterAdmin()){
         $departments = Department::where('is_active',1)->get();
         // $assigned = Department_employee_ticket::where('ticket_id',$ticketId)->get();
         $getAssignedEmp = Department_employee_ticket::where('ticket_id',$ticketId)->pluck('dept_employee_id');
         $assigned = Department_employee::whereIn('id',$getAssignedEmp)->get();
         // dd($assigned);
       }
       else{
         $agentDepartmentIds = Agent_department::where('user_id',Auth::user()->id)->where('is_active',1)->pluck('department_id');
         $departments = Department::whereIn('id', $agentDepartmentIds)->get();
         $getAssignedEmp = Department_employee_ticket::where('ticket_id',$ticketId)->pluck('dept_employee_id');
         $assigned = Department_employee::whereIn('id',$getAssignedEmp)->where('department_id',$departmentId)->get();
       }

      return view('tickets.display_ticket',[
        'ticket'   => Ticket::find($id),
        'comments' => $comments,
        'employees'=> $employees,
        'assigned' => $assigned,
        'departmentEmployeeTickets' => $departmentEmployeeTickets,
        'departments' => $departments,
      ]);
    }

    public function changeTicketStatus(Request $request)
    {
      $validator = Validator::make($request->all(),[
            'ticket_status' => 'required|int',
        ]);

      if($validator->fails()){
          alert()->warning('Error occured',$validator->errors()->all()[0]);
          return redirect()->back()->withInput()->withErrors($validator);
        }

        $ticketId = $request->post('ticket_id');
        $statusNumber = $request->post('ticket_status');
        $getTicket = Ticket::where('id',$ticketId)->first();
        $departmentId = $getTicket->department_id;
        $reassignDepartmentId = $request->post('department');
        $reassignDeptTicketCategoryId = $request->post('category');

          if($statusNumber == 2){
              $ticket = Ticket::find($ticketId);
              $ticket->department_id = $reassignDepartmentId;
              $ticket->dept_ticket_category_id = $reassignDeptTicketCategoryId;
              $ticket->status = $statusNumber;
              $ticket->save();

              $departmentEmployeeTickets = Department_employee_ticket::where('ticket_id',$ticketId)->where('is_active',1)->get();
              foreach ($departmentEmployeeTickets as $item) {
                $item->is_active = 0;
                $item->save();
              }

              // Notify admin
              $user1 = User::where('access_level', 'master_admin')->first();
              $user1->notify(new ReassignTicketNotification($ticketId));

              // Notify Department
              $getDepartmentUser = Department::where('id',$departmentId)->pluck('user_id');
              $user2 = User::where('id',$getDepartmentUser)->first();
              $user2->notify(new ReassignTicketNotification($ticketId));

          }
          elseif($statusNumber == 1){
            $ticket = Ticket::find($ticketId);
            $ticket->status = $statusNumber;
            $ticket->save();

            // Notify admin
            $user1 = User::where('access_level', 'master_admin')->first();
            $user1->notify(new SolveTicketNotification($ticketId));

            if(Auth::user()->isMasterAdmin())
            {
                // Notify Department
                $getDepartmentUser = Department::where('id',$departmentId)->pluck('user_id');
                $user2 = User::where('id',$getDepartmentUser)->first();
                $user2->notify(new SolveTicketNotification($ticketId));
            }

            if(Auth::user()->canDepartmentAdmin())
            {
              // Notify Agent
              $getTicketUser = Ticket::where('id', $ticketId)->pluck('user_id');
              $user3 = User::where('id',$getTicketUser)->first();
              $user3->notify(new SolveTicketNotification($ticketId));
            }

          }
          elseif($statusNumber == 0){
            $ticket = Ticket::find($ticketId);
            $ticket->status = $statusNumber;
            $ticket->save();

            // Notify admin
            $user1 = User::where('access_level', 'master_admin')->first();
            $user1->notify(new CloseTicketNotification($ticketId));

            // Notify Department
            $getDepartmentUser = Department::where('id',$departmentId)->pluck('user_id');
            $user2 = User::where('id',$getDepartmentUser)->first();
            $user2->notify(new CloseTicketNotification($ticketId));
          }

        Alert::success('Success', 'successfully Updated');
        return redirect()->route('ticket.display',$ticketId);

    }

    public function changeEmployeeStatus(Request $request){
          $validator = Validator::make($request->all(),[
                'ticket_id'               =>   'required|int',
                'dept_employee_ticket_id' =>   'required|int',
                'employee_status'         =>   'required|int',
            ]);

          if($validator->fails()){
              alert()->warning('Error occured',$validator->errors()->all()[0]);
              return redirect()->back()->withInput()->withErrors($validator);
            }

            $ticketId = $request->post('ticket_id');
            $deptEmployeeTicketId = $request->post('dept_employee_ticket_id');
            $employeeStatusNumber = $request->post('employee_status');

            if($employeeStatusNumber != 0)
            {
                $dept_employee_ticket = Department_employee_ticket::find($deptEmployeeTicketId);
                $dept_employee_ticket->is_active = 1;

                // Notify admin
                $user1 = User::where('access_level', 'master_admin')->first();
                $user1->notify(new ActiveEmpolyeeTicketNotification($deptEmployeeTicketId));

                // Notify department
                $getEmployeeID = Department_employee_ticket::where('id',$deptEmployeeTicketId)->pluck('dept_employee_id');
                $getDepartmentEmployeeUser = Department_employee::where('id',$getEmployeeID)->pluck('department_id');
                $getDepartmentUser = Department::where('id',$getDepartmentEmployeeUser)->pluck('user_id');
                $user2 = User::where('id',$getDepartmentUser)->first();
                $user2->notify(new ActiveEmpolyeeTicketNotification($deptEmployeeTicketId));
            }
            elseif($employeeStatusNumber == 0)
            {
                $dept_employee_ticket = Department_employee_ticket::find($deptEmployeeTicketId);
                $dept_employee_ticket->is_active = 0;

                // Notify admin
                $user1 = User::where('access_level', 'master_admin')->first();
                $user1->notify(new InactiveEmpolyeeTicketNotification($deptEmployeeTicketId));

                // Notify department
                $getEmployeeID = Department_employee_ticket::where('id',$deptEmployeeTicketId)->pluck('dept_employee_id');
                $getDepartmentEmployeeUser = Department_employee::where('id',$getEmployeeID)->pluck('department_id');
                $getDepartmentUser = Department::where('id',$getDepartmentEmployeeUser)->pluck('user_id');
                $user2 = User::where('id',$getDepartmentUser)->first();
                $user2->notify(new InactiveEmpolyeeTicketNotification($deptEmployeeTicketId));
            }

            $dept_employee_ticket->save();
            Alert::success('Success', 'successfully Updated');
            return redirect()->route('ticket.display',$ticketId);
    }

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

    public function saveCreated(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'title'         => 'required|min:3',
            'department'    => 'required|exists:departments,id',
            'category'      => 'required',
            'priority'      => 'required',
            'description'   => 'required|min:5'
        ]);

        if ($validator->fails()){
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
          }
        $imageNames = array();
        $filenames = array();
        // uploading Images

          if($request->imagesToUpload){
              $count = 1;
              foreach ($request->imagesToUpload as $image) {
                $name = Auth::user()->id.'_'.self::uniqueString().++$count.'.'.$image->extension();
                $image->move(public_path('ticket_images'), $name);
                $imageNames[] = $name;
              }
            }

        // uploading Files

        if($request->filesToUpload){
          $count = 1;
          foreach ($request->filesToUpload as $file) {
            $name = Auth::user()->id.'_'.self::uniqueString().++$count.'.'.$file->extension();
            $file->move(public_path('ticket_files'), $name);
            $filenames[] = $name;
          }
        }
        $image_string =  implode(",", $imageNames);
        $file_string =  implode(",", $filenames);

        $ticket = new Ticket();
        $ticket->user_id = Auth::user()->id;
        $ticket->department_id = $request->post('department');
        $ticket->dept_ticket_category_id = $request->post('category');
        $ticket->title = $request->post('title');
        $ticket->customer_name = $request->post('customer_name');
        $ticket->customer_phone = $request->post('phone');
        $ticket->priority = $request->post('priority');
        $ticket->description = $request->post('description');
        $ticket->file_urls = $file_string;
        $ticket->img_urls = $image_string;
        $ticket->status = 2;
        $ticket->save();

        // Notify admin
        $user1 = User::where('access_level', 'master_admin')->first();
        $user1->notify(new TicketCreateNotification($ticket->id));
        // Notify Department
        $getDepartmentUser = Department::where('id', $request->post('department'))->pluck('user_id');
        $user2 = User::where('id',$getDepartmentUser)->first();
        $user2->notify(new TicketCreateNotification($ticket->id));

        Alert::success('Success', 'successfully added');
        return redirect()->route('ticket.create');
    }

    public function displayAllTickets(Request $request)
    {

      return view('tickets.ticket_list',[
        "creators" => User::where('access_level','!=','department_admin')->get(),
        "departments" => Department::where("is_active",1)->get(),
      ]);
    }

    public function getAllTickets(Request $request)
    {

      $tickets = "";
      if($request->post('department_id'))
      {
        $tickets = Ticket::where('department_id',$request->post('department_id'));
      }

      if ($request->post('priority'))
      {
          if($tickets == "")
          {
            $tickets = Ticket::where('priority',$request->post('priority')-1);
          }
          else{
            $tickets = $tickets->where('priority',$request->post('priority')-1);
          }
       }

        if ($request->post('creator'))
        {
            if($tickets == "")
            {
              $tickets = Ticket::where('user_id',$request->post('creator'));
            }
            else{
              $tickets = $tickets->where('user_id',$request->post('creator'));
            }
        }

        if ($request->search['value'])
        {
            $filtedval = $request->search['value'];
            if($tickets == "")
            {
              $tickets = Ticket::where('id', 'like', '%' . $filtedval . '%')
                                  ->orWhere('title', 'like', '%' . $filtedval . '%');
            }
            else
            {
              $tickets = $tickets->where('id', 'like', '%' . $filtedval . '%')
                                  ->orWhere('title', 'like', '%' . $filtedval . '%');
            }
        }

        if($tickets == "")
        {
            $tickets = Ticket::orderBy('priority', 'DESC')
                              ->orderBy('status', 'DESC')
                              ->skip(intval($request->input('start')))
                              ->take(intval($request->input('length')))
                              ->get();
        }
        else
        {
            $tickets = $tickets->orderBy('priority', 'DESC')
                                ->orderBy('status', 'DESC')
                                ->skip(intval($request->input('start')))
                                ->take(intval($request->input('length')))
                                ->get();
        }

        $totalData = $tickets->count();
        $totalFiltered = $totalData;

        $toReturn = array();
        foreach ($tickets as $item) {
              $show      =  route('ticket.display',$item->id);
              $localArray[0] = $item->id;
              $localArray[1] = $item->title;
              $localArray[2] = $item->department->name;
              $localArray[3] = $item->dept_ticket_category_id == 0 ? "Others" : $item->ticketCategory->category;
              $localArray[4] = Ticket::getPriorityArray()[$item->priority];
              $localArray[5] = $item->user->name;;
              $localArray[6] = $item->created_at->format('d.m.Y');
              $localArray[7] = "<a href='{$show}' class='btn btn-sm btn-primary'>view</a>";
            $toReturn[] = $localArray;
        }

      $json_data = array(
         "draw" => intval($request->input('draw')),
         "recordsTotal" => intval($totalData),
         "recordsFiltered" => intval($totalFiltered),
         "data" => $toReturn
     );
     echo json_encode($json_data);

   }

    public function displayOpenTickets(Request $request)
    {
      return view('tickets.open_ticket',[
        "creators" => User::where('access_level','!=','department_admin')->get(),
        "departments" => Department::where("is_active",1)->get(),
      ]);

    }

    public function getTickets(Request $request)
    {
        if(Auth::user()->isMasterAdmin()){
          $tickets = "";
        }
        elseif(Auth::user()->isAgent()){
            $agentDepartmentIds = Agent_department::where('user_id',Auth::user()->id)->where('is_active',1)->pluck('department_id');
            $tickets = Ticket::whereIn('department_id',$agentDepartmentIds);
        }
        elseif(Auth::user()->canDepartmentAdmin()){
          $DepartmentIds = Department::where('user_id',Auth::user()->id)->where('is_active',1)->pluck('id');
          $tickets = Ticket::whereIn('department_id',$DepartmentIds);
        }

        if($request->post('department_id'))
        {
          $tickets = Ticket::where('department_id',$request->post('department_id'));
        }

        if ($request->post('priority'))
        {
            if($tickets == "")
            {
              $tickets = Ticket::where('priority',$request->post('priority')-1);
            }
            else{
              $tickets = $tickets->where('priority',$request->post('priority')-1);
            }
         }

          if ($request->post('status'))
          {
              if($tickets == "")
              {
                $tickets = Ticket::where('status',$request->post('status')-1);
              }
              else{
                $tickets = $tickets->where('status',$request->post('status')-1);
              }
          }

          if ($request->search['value'])
          {
              $filtedval = $request->search['value'];
              if($tickets == "")
              {
                $tickets = Ticket::where('id', 'like', '%' . $filtedval . '%')
                                    ->orWhere('title', 'like', '%' . $filtedval . '%');
              }
              else
              {
                $tickets = $tickets->where('id', 'like', '%' . $filtedval . '%')
                                    ->orWhere('title', 'like', '%' . $filtedval . '%');
              }
          }

          if($tickets == "")
          {
              $tickets = Ticket::orderBy('priority', 'DESC')
                                ->orderBy('status', 'DESC')
                                ->skip(intval($request->input('start')))
                                ->take(intval($request->input('length')))
                                ->get();
          }
          else
          {
              $tickets = $tickets->orderBy('priority', 'DESC')
                                  ->orderBy('status', 'DESC')
                                  ->skip(intval($request->input('start')))
                                  ->take(intval($request->input('length')))
                                  ->get();
          }

          $totalData = $tickets->count();
          $totalFiltered = $totalData;

          $toReturn = array();
          foreach ($tickets as $item) {
                $show      =  route('ticket.display',$item->id);
                $localArray[0] = $item->id;
                $localArray[1] = $item->title;
                $localArray[2] = $item->department->name;
                $localArray[3] = $item->dept_ticket_category_id == 0 ? "Others" : $item->ticketCategory->category;
                $localArray[4] = Ticket::getPriorityArray()[$item->priority];
                $localArray[5] = $item->created_at->format('d.m.Y');
                $localArray[6] = "<a href='{$show}' class='btn btn-sm btn-primary'>view</a>";
              $toReturn[] = $localArray;
          }

        $json_data = array(
           "draw" => intval($request->input('draw')),
           "recordsTotal" => intval($totalData),
           "recordsFiltered" => intval($totalFiltered),
           "data" => $toReturn
       );
       echo json_encode($json_data);
    }
    public function getSolvedTickets(Request $request)
    {
      return view('tickets.solved_ticket',[
        "creators" => User::where('access_level','!=','department_admin')->get(),
        "departments" => Department::where("is_active",1)->get(),
      ]);

    }
    public function getClosedTickets(Request $request)
    {
      return view('tickets.closed_ticket',[
        "creators" => User::where('access_level','!=','department_admin')->get(),
        "departments" => Department::where("is_active",1)->get(),
      ]);
    }
    private function uniqueString()
    {
        $m = explode(' ', microtime());
        list($totalSeconds, $extraMilliseconds) = array($m[1], (int)round($m[0] * 1000, 3));
        $txID = date('YmdHis', $totalSeconds) . sprintf('%03d', $extraMilliseconds);
        $txID = substr($txID, 2, 15);
        return $txID;
    }
}
