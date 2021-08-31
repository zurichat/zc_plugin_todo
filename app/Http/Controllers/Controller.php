<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function editTask(Request $req){
      $task = Task::find($id);
      $req->validate([
        'title'=>"required",
        'description'=>"required"
      ]);

      $task->title = $req->input('title');
      $task->description = $req->input('description');

      $task->save();


    }
}
