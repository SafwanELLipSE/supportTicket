<?php

namespace App\Http\Controllers;

use App\Department;
use App\Agent_department;
use App\Ticket;
use App\User;
use App\Ticket_comment;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TicketController extends Controller
{
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

          Alert::success('Success', 'successfully added');
          return redirect()->route('ticket.display',$comments->ticket_id);
    }

    public function displayTicket(Request $request,$id)
    {
      $ticketId = Ticket::find($id)->id;
      $comments = Ticket_comment::where('ticket_id',$ticketId)->get();

      return view('tickets.display_ticket',[
        'ticket' => Ticket::find($id),
        'comments' => $comments
      ]);
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
