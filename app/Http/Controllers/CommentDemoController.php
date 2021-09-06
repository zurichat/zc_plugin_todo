<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentDemoController extends Controller
{
    //
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
    }
}
