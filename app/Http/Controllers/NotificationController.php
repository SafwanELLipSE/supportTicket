<?php

namespace App\Http\Controllers;

use App\Notification;
use App\User;

use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
      return view('personal.notification');
    }
    public function markNotification(Request $request)
    {
          $notificationId = $request->post('notification_id');
          $userId = $request->post('user_id');

          $getUser = User::where('id',$userId)->first();
          $notifaction = $getUser->Notifications->find($notificationId);

          if($notifaction){
             $notifaction->markAsRead();
          }

          Alert::success('Success', 'Successfully Marked');
          return redirect()->back();
    }
    public function deleteNotification(Request $request)
    {
        $notificationId = $request->post('notification_id');
        $userId = $request->post('user_id');

        $getUser = User::where('id',$userId)->first();
        $notifaction = $getUser->Notifications->find($notificationId);

        if($notifaction){
           $notifaction->delete();
        }

        Alert::success('Success', 'Successfully Marked');
        return redirect()->back();
    }
    public function markAllNotification(Request $request,$id)
    {
        $getUser = User::find($id);
        $getUser->unreadNotifications
        ->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })
        ->markAsRead();

        Alert::success('Success', 'Successfully Marked All Notifications');
        return redirect()->back();
    }
}
