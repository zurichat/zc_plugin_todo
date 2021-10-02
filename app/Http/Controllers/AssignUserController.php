<?php

namespace App\Http\Controllers;

use App\Helpers\Collaborator;

use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Repositories\Mail\mail;

class AssignUserController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function assign(Request $request, $todoId)
    {
        $email = $request->email;
        $name = $request->name;
        // instance of email
        $sendMail = new mail;

        $todo = $this->todoService->find($todoId);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }

        if (!Collaborator::isAdmin($todo, $request['user_id'])) {
            return response()->json(['message' => 'Lack authorization'], 401);
        }

        $newColabo = ['collaborator_id' => $request->collaborator_id, 'admin_status' => $request->admin_status];
        array_push($todo['collaborators'], $newColabo);
        unset($todo['_id']);

        $result = $this->todoService->update($todo, $todoId);
        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {

            // Publish To Centrifugo
            $this->todoService->publishToCommonRoom(
                $todo,
                $todo['channel'],
                $request->collaborator_id,
                'Todo',
                null
            );

            //send mail
            
            $sendMail->sendMail($email, $name);

            return response()->json(
                [
                    "status" => "success",
                    "type" => "Todo", "data" => array_merge(['_id' => $todoId], $todo)
                ],
                200
            );
        }

        return response()->json(['status' => "error", 'message' => $result], 500);
    }




    public function remove(Request $request, $todoId)
    {

        $todo = $this->todoService->find($todoId);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }

        if (!Collaborator::isAdmin($todo, $request['user_id'])) {
            return response()->json(['message' => 'Lack authorization'], 401);
        }

        $removeColabo = ['collaborator_id' => $request->collaborator_id, 'admin_status' => '0'];

        unset($todo['collaborators'], $removeColabo);
        unset($todo['_id']);

        $result = $this->todoService->update($todo, $todoId);
        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {

            // Publish To Centrifugo

            $this->todoService->publishToCommonRoom(
                $todo,
                $todo['channel'],
                null,
                'Todo',
                $request->collaborator_id
            );

            return response()->json(["status" => "success", "type" => "Todo", "data" => "User removed successfully"], 200);
        }

        return response()->json(['status' => "error", 'message' => $result], 500);
    }
}
