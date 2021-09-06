<?php

namespace App\Http\Controllers;

use App\Services\TaskCommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TaskCommentController extends Controller
{
    protected $taskCommentService;

    public function __construct(TaskCommentService $taskCommentService)
    {
        $this->taskCommentService = $taskCommentService;
    }

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
		if (!empty($request->user_id) && !empty($request->task_id)){
			return response()->json($this->taskCommentService->create($request->all()));
		} else {
			// create random ids for comment
			$userId = rand(1, 20);
			$taskId = 1;

			// sketch the response data
			$data = [
				"content" => $request->content,
				"task_id" => $taskId,
				"user_id" => $userId,
				"created_at" => Carbon::now(),
			];

			// return response
			return response()->json($this->taskCommentService->create($data));
		}
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
        $comment = $this->taskCommentService->find($id);
        if(!$comment){
            return response()->json(['message' => 'Comment not found'], 404);    
        }
        return response()->json($this->taskCommentService->update($request->all(), $comment['_id']));
    }

    public function editcomment($id){
        $comment = $this->taskCommentService->find($id);
        if(!$comment){
            return response()->json(['message' => 'Comment not found'], 404);    
        }
        return view('editcomment')->with([
            'id' => $id,
            'comment' => $comment,
        ]);
    }

    public function delete($id)
    {
        return response()->json($this->taskCommentService->delete($id));
    }
}
