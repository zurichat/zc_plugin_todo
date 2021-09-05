<?php

namespace App\Http\Controllers;

use App\Services\TaskCommentService;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;



class TaskCommentController extends Controller
{
    // Service Dependency Injection
    protected $taskCommentService;

    public function __construct(TaskCommentService $taskCommentService)
    {
        $this->taskCommentService = $taskCommentService;
    }


    public function index()
    {
        return response()->json($this->taskCommentService->all());
    }

    public function saveComment(Request $request)
    {
        $input = $request->validate([
            'user_id' => 'required',
            'task_id' => 'required',
            'body' => 'required|string'
        ]);

        $payload = array_merge($input, ['parent_id' => null, 'creted_at' => Carbon::now()->toDateString()]);
        return response()->json($this->taskCommentService->create($payload));
    }

    public function getCommentsPerTask($taskId)
    {
        return response()->json($this->taskCommentService->allCommentPerTask('task_id', $taskId));
    }


    /**
     * @author {Alpha2Chris14}
     */
    public function findTaskCommentById($id)
    {
        return response()->json($this->taskCommentService->findTaskCommentById($id));
    }

    public function findTaskCommentByIdTest($id)
    {
        $url = $this->taskCommentService->all();

        $datas = $url["data"];

        $comments = array();
        foreach ($datas as $data) {
            if (array_key_exists('task_id', $data)) {
                $taskId = $data["task_id"];
                if ($taskId == $id) {
                    $comments[] = $data;
                }
            }
        }

        return response()->json($comments);
    }

    public function show($id)
    {
        return response()->json($this->taskCommentService->find($id));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->taskCommentService->update($request->all(), $id));
    }

    public function delete($id)
    {
        return response()->json($this->taskCommentService->delete($id));
    }
}
