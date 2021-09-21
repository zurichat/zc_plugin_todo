<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\TodoService;

class UsersController extends Controller
{

    protected $todoService;


    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

   public function usersInRoom($id)
    {
      //Get the room we want to users from.
      $roomData = $result = $this->todoService->find($id);
      
      $users_ids = $roomData['colaborators'];


      // $usersInfo = [];
      // foreach($users_ids as $id){
      //     $data['user_id'] = $id;
      //     $data['session_id'] = $request->token;
      //   $user = $this->todoRepository->findUser($data);

      // }
    //   $data = [
    //     'token' => $request->token,
    //     'org' => $request->org
    //   ];
    //   $users_ids = $usersInRoom[0]['users'];
    //   $usersInfo = [];
    //   for ($i = 0; $i < count($users_ids); $i++) {
    //     $data['user_id'] = $users_ids[$i];
    //     $user = $this->todoRepository->findUser($data);
    //     $usersInfo[] = collect($user)->only(['display_name', 'email', 'first_name', 'last_name', 'phone']);
    //   }

    //   return response()->json(["users" => $usersInfo], 200);
    return response()->json(['users' => $users_ids], 200);
    }
}
