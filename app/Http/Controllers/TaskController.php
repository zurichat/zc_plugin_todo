<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function getTaskCollection($id)
    {
        $user = [
            'id' => $id,
            'name' => 'Olayinka',
            'tasks' => ['play games', 'go to church', 'wake up by 5']
        ];

        return response()->json([
            'status' => 'success',
            'error' => false,
            'message' => 'user found',
            'data' => [
                'user' => $user
            ]
        ], 200);
    }
}
