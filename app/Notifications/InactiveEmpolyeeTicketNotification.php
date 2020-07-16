<?php

namespace App\Notifications;

use App\Department_employee_ticket;
use App\Department_employee;
use App\Ticket;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InactiveEmpolyeeTicketNotification extends Notification
{
    use Queueable;

    public $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
     public function __construct($details)
     {
         $this->details = $details;
     }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
      $getEmployeeTicket = Department_employee_ticket::where('id',$this->details)->first();
      $employeeID = $getEmployeeTicket->dept_employee_id;
      $ticketID = $getEmployeeTicket->ticket_id;

      $getEmployee = Department_employee::where('id',$employeeID)->first();
      $name = $getEmployee->name;
      $email = $getEmployee->email;

      $getTicket = Ticket::where('id',$ticketID)->first();
      $title = $getTicket->title;

      $status = "Inactive";

      return [
        "name" => $name,
        "email" => $email,
        "title" => $title,
        "status" => $status,
      ];
    }
}
