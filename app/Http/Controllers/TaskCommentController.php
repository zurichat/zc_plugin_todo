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
    }

    public function store(Request $request)
    {
        // create a random id for comment
        $id = rand(1, 20);
        $userId = rand(1, 20);
        $taskId = 1;
        // sketch the response data
        $data = [
            "content" => $request->content,
            "task_id" => $taskId,
            "user_id" => $userId,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];

        // return response
        return response()->json($this->taskCommentService->create($data));
    }

    /**
        * @author {Alpha2Chris14}
    */
    public function findTaskCommentById($id){
        return response()->json($this->taskCommentService->findTaskCommentById($id));
    }

    public function findTaskCommentByIdTest($id){
        $ch = curl_init();
        $url = 'https://todo.zuri.chat/api/comment/1';
        $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
    
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
        $response = curl_exec($ch);
        $values = json_decode($response,true);

        $datas = $values["data"];
        // print_r($datas);

        $comments = array();
        
        
        foreach($datas as $data){
            //echo ($data['task_id'])."<br>";
            // 
            if(array_key_exists('task_id',$data)){
                $taskId = $data["task_id"];
                if($taskId == $id){
                    $comments[] = $data;
                }
            }
        }
        
        return response()->json($comments);
    }

    //ends here

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function delete($id)
    {
    }
}
