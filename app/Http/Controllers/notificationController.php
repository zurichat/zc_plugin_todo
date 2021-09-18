<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskAssignNotification;
use Illuminate\Notifications\Notifiable;

class notificationController extends Controller
{
    use Notifiable;
    public $user;

    public function __construct($user='')
    {
        $this->user = $user;
    }

    public function user() {
        return $this->user;
      }
    public function sendTaskAssignNotification() {
        
        $user = new notificationController('Mark');
        $taskData = [
            'name' => "Approve Pull Requests",
            'body' => "You are to test and approve pull requests submitted by stage 4 interns on the issue-review channel ",
            'thanks' => "Thank you",
            'task_id' => "1086"
        ];
        
        //Notification::sendNow($user, new TaskAssignNotification($taskData));
        //Notification::route('mail', $user)->notify;
        //return response()->json([$taskData]);
        dd([$taskData]);
    }
}
