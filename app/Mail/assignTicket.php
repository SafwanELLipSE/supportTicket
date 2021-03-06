<?php

namespace App\Mail;
use App\Ticket;
use App\Department;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class assignTicket extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($details)
     {
         $this->details = $details;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $get_ticket = Ticket::where('id',$this->details)->first();

        $ticket_files = $get_ticket->file_urls;
        $arrayOfFiles = explode(',',$ticket_files);
        $ticket_images = $get_ticket->img_urls;
        $arrayOfImages = explode(',',$ticket_images);

        $ticket_departmentId = $get_ticket->department_id;
        $ticket_deptTicketCategoryId = $get_ticket->dept_ticket_category_id;
        $ticket_title = $get_ticket->title;
        $ticket_priority = $get_ticket->priority;
        $ticket_desc = $get_ticket->description;

        $email = $this->view('mails.mail_assign_ticket')->subject('Employment Application')
                      ->with([
                              'ticketTitle' => $ticket_title,
                              'ticketDepartment' => $ticket_departmentId,
                              'ticketCategory' => $ticket_deptTicketCategoryId,
                              'ticketPriority' => $ticket_priority,
                              'ticketDesc' =>  $ticket_desc,
                          ]);

          foreach ($arrayOfFiles as $file){
            if($file != "")
            {
              $email->attach(public_path(). '/ticket_files/'. $file); // attach each file
            }
          }

          foreach ($arrayOfImages as $image) {
            if($image != "")
            {
              $extension = explode('.',$image);
              $email->attach(public_path().'/ticket_images/'. $image,['mime' => 'image/'.$extension[1] ]);// attach each file
            }
          }

        return $email;
    }
}
