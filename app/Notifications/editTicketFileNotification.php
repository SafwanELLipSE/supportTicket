<?php

namespace App\Notifications;

use App\Ticket;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class editTicketFileNotification extends Notification
{
    use Queueable;
    public $details1;
    public $details2;
    public $details3;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
     public function __construct($details1,$details2,$details3)
     {
         $this->details1 = $details1;
         $this->details2 = $details2;
         $this->details3 = $details3;
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
      $getTicket = Ticket::where('id',$this->details1)->first();
      $title = $getTicket->title;

      return [
          "title" => $title,
          "from_image_name" => $this->details2,
          "to_image_name" => $this->details3,
      ];
    }
}
