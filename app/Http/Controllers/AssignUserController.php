<?php

namespace App\Http\Controllers;

use App\Constants\AppConstants;
use App\Helpers\Collaborator;
use App\Http\Requests\CollaboratorRequest;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AssignUserController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function assign(CollaboratorRequest $request, $todoId)
    {
        $todo = $this->todoService->find($todoId);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }

        if (!Collaborator::isAdmin($todo, $request['user_id'])) {
            return response()->json(['message' => 'Lack authorization'], 401);
        }

        $newColabo = $request->only('collaborator_id', 'admin_status');
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
                $removeColabo,
                $todo['channel'],
                null,
                AppConstants::TYPE_COLLABORATOR,
                $request->collaborator_id
            );

            return response()->json(["status" => AppConstants::MSG_200,  "data" => $removeColabo], 200);
        }

        return response()->json(['status' => AppConstants::MSG_500, 'message' => $result], AppConstants::STATUS_ERROR);
    }

    public function fetch($todoId)
    {
        $todo = $this->todoService->find($todoId);

        if (isset($todo['status']) && $todo['status'] == AppConstants::STATUS_NOT_FOUND) {
            return response()->json($todo, AppConstants::STATUS_NOT_FOUND);
        }

        return response()->json([
            'status' => AppConstants::MSG_200,
            'type' => AppConstants::TYPE_COLLABORATORS,
            'count' => count($todo['collaborators']),
            'data' => Collaborator::sortAdminFirst($todo['collaborators'])
        ], 200);
    }
}
