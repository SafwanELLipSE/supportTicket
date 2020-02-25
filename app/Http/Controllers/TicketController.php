<?php

namespace App\Http\Controllers;

use App\Department;
use App\Agent_department;
use App\Ticket;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TicketController extends Controller
{
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
        $ticket->status = 1;
        $ticket->save();
        Alert::success('Success', 'successfully added');
        return redirect()->route('ticket.create');
    }

    public function displayAllTickets(Request $request)
    {

      return view('tickets.ticket_list');
    }

    public function getAllTickets(Request $request)
    {
      $tickets = Ticket::orderBy('status', 'DESC')->orderBy('priority', 'DESC')->get();

      $totalData = $tickets->count();
      $totalFiltered = $totalData;

      $toReturn = array();
      $count = 1;
          foreach ($tickets as $item) {
                $localArray[0] = $item->id;
                $localArray[1] = $item->title;
                $localArray[2] = $item->department_id;
                $localArray[3] = $item->dept_ticket_category_id;
                $localArray[4] = $item->priority;
                $localArray[5] = $item->user_id;
                $localArray[6] = $item->created_at;
                $localArray[7] = "view";
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

    public function getOpenTickets(Request $request)
    {
      return view('tickets.create_ticket');
    }
    public function getSolvedTickets(Request $request)
    {
      return view('tickets.create_ticket');
    }
    public function getClosedTickets(Request $request)
    {
      return view('tickets.create_ticket');
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
