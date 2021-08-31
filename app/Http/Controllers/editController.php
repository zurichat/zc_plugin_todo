<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class editController extends Controller
{

  //............Edit or Modify task function.................//
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
