<?php

namespace App\Http\Controllers;

use App\Constants\AppConstants;
use App\Helpers\Collaborator;
use App\Http\Requests\PriviledgeRequest;
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

    public function adminPrivilege(PriviledgeRequest $request, $todoId)
    {
        // Find the todo and check if it exists
        $todo = $this->todoService->find($todoId);

        if (isset($todo['status']) && $todo['status'] == AppConstants::STATUS_NOT_FOUND) {
            return response()->json($todo, AppConstants::STATUS_NOT_FOUND);
        }
        // Some extra validations to check if the user performing this action is an Admin
        if (!Collaborator::isAdmin($todo, $request->creator_id)) {
            return response()->json(['message' => AppConstants::MSG_403], AppConstants::STATUS_FORBIDDEN);
        }

        // find the collaborator and grant or revoke the privilege admin privilege
        foreach ($todo['collaborators'] as $key =>  $collaborator) {

            if ($collaborator['collaborator_id'] == $request->collaborator_id) {
                $todo['collaborators'][$key]['admin_status'] = $request->admin_status;
            }
        }
        unset($todo['_id']);

        $result = $this->todoService->update($todo, $todoId);
        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {

            $this->todoService->publishToRoomChannel(
                $todo['channel'],
                $todo['collaborators'],
                AppConstants::TYPE_COLLABORATORS,
                AppConstants::ACTION_TOGGLE_ADMIN
            );
            return response()->json([
                "status" => AppConstants::MSG_200,
                'type' => AppConstants::TYPE_COLLABORATORS, "data" => Collaborator::sortAdminFirst($todo['collaborators'])
            ], AppConstants::STATUS_OK);
        } else {
            return response()->json(["status" => AppConstants::MSG_500, "error" => $result], AppConstants::STATUS_ERROR);
        }
    }
}
