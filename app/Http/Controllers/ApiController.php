<?php

namespace App\Http\Controllers;

use App\Models\TaskPriority;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function create(Request $request) {
        $task = new TaskPriority();

        $task->name = $request->input('name');
        

        $task->save();
        return response()->json($task);
    }

    public function showall() {
        $task = TaskPriority::all();
        return response()->json($task);
    }

    public function updatebyid(Request $request, $id) {
        $task = TaskPriority::find($id);
        $task->name = $request->input('name');
        
    
        $task->save();
        return response()->json($task);
    }
}

