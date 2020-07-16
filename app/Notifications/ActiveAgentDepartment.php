<?php

namespace App\Notifications;

use App\User;
use App\Department;
use App\Agent_department;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ActiveAgentDepartment extends Notification
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
      $getAgentDepartment = Agent_department::where('id',$this->details)->first();

      $userID = $getAgentDepartment->user_id;
      $departmentID = $getAgentDepartment->department_id;

      $getUser = User::where('id',$userID)->first();
      $getDeaprtment = Department::where('id',$departmentID)->first();

      $nameUser = $getUser->name;
      $emailUser = $getUser->email;
      $nameDepartment = $getDeaprtment->name;

      return [
        "name" => $nameUser,
        "email" => $emailUser,
        "department" => $nameDepartment,
      ];
    }
}
