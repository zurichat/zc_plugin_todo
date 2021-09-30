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
        // Find the todo and check if it exists
        $todo = $this->todoService->find($todoId);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }
        // Some extra validations to check if the user performing this action is the creator
        if($request->creator_id != $todo['user_id']){
            return response()->json('This action can only be performed by the owner of this todo', 400);
        }
        $validator = Validator::make($request->all(),[
            'privilege' => 'required|integer|digits_between:0,1'
        ]);
        if($validator->fails()) return response()->json(['errors'=>$validator->errors()],400);

        // find the collaborator and grant or revoke the privilege admin privilege
        foreach ($todo['collaborators'] as $key => $value) {
            # code...

            if($todo['collaborators'][$key]['user_id'] == $request->collaborator_id) {
                $todo['collaborators'][$key]['admin_status'] = $request->privilege;
            }
        }
        unset($todo['_id']);

        $result = $this->todoService->update($todo, $todoId);
        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {
            return response()->json(["status" => "success", "data" => array_merge(['_id' => $todoId], $todo)], 200);
        }else{
            return response()->json(["status" => "error", "data" => $result], 500);
        }

    }
}
