<?php

namespace App\Http\Controllers;
use App\Repositories\RoomRepository;
use Illuminate\Http\Request;
use App\Repositories\TodoRepository;
use App\Traits\HTTPRepoResponseHandler;
class UsersController extends Controller
{

    use HTTPRepoResponseHandler;

    protected $todoRepository, $roomRepository;

     function __construct(TodoRepository $todoRepository, RoomRepository $roomRepository)
    {
        $this->todoRepository = $todoRepository;
        $this->roomRepository = $roomRepository;
    }

   public function usersInRoom(Request $request)
    {
      //Get the room we want to users from.
      $roomData = $this->todoRepository->allWithoutDeletedWhere(['organisation_id' => $request->org, 'room_id' => $request->room]);
      
      $users_ids = $roomData[0]['users'];


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
    return reponse()->json(['users' => $users_ids], 200);
    }
}
