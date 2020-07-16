<?php

namespace App\Notifications;

use App\User;
use App\Department;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class editDepartmentNotifiaction extends Notification
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
        $getUser = User::where('id',$this->details)->first();
        $getDepartment = Department::where('id',$getUser->id)->first();

        $name = $getUser->name;
        $email = $getUser->email;
        $department = $getDepartment->name;

        return [
          "name" => $name,
          "email" => $email,
          "department" => $department,
        ];
    }
}
