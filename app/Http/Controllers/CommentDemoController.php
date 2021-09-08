<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskCommentService;
class CommentDemoController extends Controller
{
    //
    protected $taskCommentService;

    public function __construct(TaskCommentService $taskCommentService)
    {
        $this->taskCommentService = $taskCommentService;
    }
    public function editcomment($id){
        $comment = $this->taskCommentService->find($id);
        if(!$comment){
            return response()->json(['message' => 'Comment not found'], 404);    
        }
        //dd($comment);
        return view('editcomment')->with([
            'id' => $id,
            'comment' => $comment,
        ]);
    }
}
