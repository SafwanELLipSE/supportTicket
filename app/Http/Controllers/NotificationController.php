<?php

namespace App\Http\Controllers;

use App\Notification;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
      return view('personal.notification');
    }
}
