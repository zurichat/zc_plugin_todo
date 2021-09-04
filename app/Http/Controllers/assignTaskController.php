<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illunminate\Support\Facades\Notification;
use App\Notifications\assignTaskNotification;

class assignTaskController extends Controller
{
    public function sendEmailNotification()
    {
        $user = "Mark";
  
        $details = [
            'greeting' => 'Hi ' . $user,
            'body' => 'This is to notify you on your newly assigned tasked, Please visit the url below to get started',
            'thanks' => 'Thank you for using todo.zuri.chat',
            'actionText' => 'View My Task',
            'actionURL' => url('/'),
            'task_id' => 101
        ];
  
        //Notification::send($user, new assignTaskNotification($details));
   
        //dd([response()->json($details)]);
        return response()->json($details);
    }
}
