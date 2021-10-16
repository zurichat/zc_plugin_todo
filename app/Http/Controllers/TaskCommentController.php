<?php

namespace App\Http\Controllers;

use App\Helpers\Sort;
use Illuminate\Http\Request;
use App\Helpers\Collaborator;
use App\Services\TodoService;
use Illuminate\Support\Carbon;
use App\Constants\AppConstants;
use App\Services\TaskCommentService;
use App\Http\Requests\CommentRequest;


class TaskCommentController extends Controller
{
    protected $todoService;
    protected $taskCommentService;

    public function __construct(TodoService $todoService, TaskCommentService $taskCommentService)
    {
        $this->todoService = $todoService;
        $this->taskCommentService = $taskCommentService;
    }

    public function getCommentsPerTask(Request $request, $taskId)
    {
        $result = $this->taskCommentService->commentsPerTask('task_id', $taskId);
        Sort::sortAsc($request);


        if ($result['status'] == 200 && isset($result["data"])) {
            return response()->json([
                'status' => AppConstants::MSG_200,
                'type' => AppConstants::TYPE_COMMENTS,
                'count' => count($result),
                'data' => $result
            ], AppConstants::STATUS_OK);
        }

        return response()->json(['message' => $result['message']], AppConstants::STATUS_NOT_FOUND);
    }


    public function saveComment(CommentRequest $request, $todoId)
    {

        $todo = $this->todoService->find($todoId);

        if (isset($todo['status']) && $todo['status'] == AppConstants::STATUS_NOT_FOUND) {
            return response()->json($todo, AppConstants::STATUS_NOT_FOUND);
        }

        $input = $request->only('user_id', 'task_id', 'body');
        $payload = array_merge($input, [
            'todo_id' => $todoId,
            'reaction' => [],
            'created_at' => Carbon::now()
        ]);

        if (!Collaborator::haveAccess($todo, $request->user_id)) {
            return response()->json(['message' => AppConstants::MSG_403], AppConstants::STATUS_FORBIDDEN);
        }

        $result = $this->taskCommentService->create($payload);

        if (isset($result['object_id'])) {
            $responseWithId = array_merge(['_id' => $result['object_id']], $payload);
            $this->taskCommentService->publishToRoomChannel(
                $todo['channel'],
                $responseWithId,
                AppConstants::TYPE_COMMENT,
                AppConstants::ACTION_CREATE
            );
            return response()->json([
                'status' => AppConstants::MSG_200,
                'type' => AppConstants::TYPE_COMMENT,
                'data' => $responseWithId
            ], AppConstants::STATUS_OK);
        }

        return response()->json(['message' => $result['message']], AppConstants::STATUS_ERROR);
    }


    public function update(Request $request, $taskId, $channel)
    {
        $comment = $this->taskCommentService->find($taskId);

        if (isset($comment['status']) && $comment['status'] == AppConstants::STATUS_NOT_FOUND) {
            return response()->json(['message' => AppConstants::MSG_404], AppConstants::STATUS_NOT_FOUND);
        }

        if (!Collaborator::isCreator($comment, $request->user_id)) {
            return response()->json(['message' => AppConstants::MSG_401], AppConstants::STATUS_NO_AUTH);
        }

        $comment['body'] = $request->body;
        unset($comment['_id']);
        $result = $this->taskCommentService->update($comment, $taskId);

        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {
            $commentWithId = array_merge(['_id' => $taskId], $comment);

            $this->taskCommentService->publishToRoomChannel(
                $channel,
                $commentWithId,
                AppConstants::TYPE_COMMENT,
                AppConstants::ACTION_UPDATE
            );

            return response()->json(
                [
                    'message' => AppConstants::MSG_204,
                    'data' => $commentWithId
                ],
                AppConstants::STATUS_OK
            );
        }

        return response()->json(
            ['status' => AppConstants::MSG_500, 'message' => $result],
            AppConstants::STATUS_ERROR
        );
    }

    public function getCommentPerTodo(Request $request, $todoId)
    {
        $result = $this->taskCommentService->commentsByKey(['todo_id' => $todoId]);
        Sort::sortAsc($request);

        return response()->json([
            'status' => AppConstants::MSG_200,
            'type' => AppConstants::TYPE_COMMENTS,
            'count' => count($result),
            'data' => $result
        ], AppConstants::STATUS_OK);
    }
}
