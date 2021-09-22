<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    protected $todoService;
    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function adminPrivilege($todoId, Request $request){
        $todo = $this->todoService->find($todoId);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }
        if($request->creator_id != $todo['user_id']){
            return response()->json('This action can only be performed by the owner of this todo', 400);
        }
        $validator = Validator::make($request->all(),[
            'privilege' => 'required|integer|digits_between:0,1'
        ]);

        if($validator->fails()) return response()->json(['errors'=>$validator->errors()],400);

        // find the collaborator and grant or revoke the privilege admin privilege
        $count = 0;
        foreach ($todo['colaborators'] as $collaborator) {
            # code...
            if($collaborator['user_id'] == $request->collaborator_id) {
                $todo['colaborators'][$count]['admin_status'] = $request->privilege;
                $this->todoService->update($todo,$todoId);
                return response()->json($todo, 200);
            }
            $count++;
        }
        return response()->json('Collaborator not found',404);
    }
}
