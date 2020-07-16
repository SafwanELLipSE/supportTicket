<?php

namespace App\Notifications;

use App\Ticket;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AssignTicketNotification extends Notification
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
        $getTicket = Ticket::where('id',$this->details)->first();

        $title = $getTicket->title;
        $department = $getTicket->department_id;
        $priority =  $getTicket->priority;
        $status = "Assigned";

        return [
          "title" => $title,
          "department" => $department,
          "priority" => $priority,
          "status" => $status,
        ];
    }
}
