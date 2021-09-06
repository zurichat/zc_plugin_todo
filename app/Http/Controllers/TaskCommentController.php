<?php

namespace App\Http\Controllers;

use App\Services\TaskCommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class TaskCommentController extends Controller
{
    protected $taskCommentService;

    public function __construct(TaskCommentService $taskCommentService)
    {
        $this->taskCommentService = $taskCommentService;
    }

    public function index()
    {
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "task_id" => "required",
            "user_id" => "required",
            "body" => "required"
        ]);

        if ($validator->passes()) {
            // sketch the response data
			$data = [
				"body" => $request->body,
				"task_id" => $request->task_id,
				"user_id" => $request->user_id,
				"created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "deleted_at" => null,
			];

            return response()->json($this->taskCommentService->create($data));
        }

        // return response
        return response()->json([
            "message" => $validator->errors()
        ], 400);


    }

    /**
        * @author {Alpha2Chris14}
    */
    public function findTaskCommentById($id){
        return response()->json($this->taskCommentService->findTaskCommentById($id));
    }

    public function findTaskCommentByIdTest($id){
        $url = $this->taskCommentService->all();

        $datas = $url["data"];
        
        $comments = array();
        foreach($datas as $data){
            if(array_key_exists('task_id',$data)){
                $taskId = $data["task_id"];
                if($taskId == $id){
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
