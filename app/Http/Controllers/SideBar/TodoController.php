<?php

namespace App\Http\Controllers\SideBar;

use App\Helpers\Constants;
use App\Http\Controllers\Controller;
use App\Http\Resources\SidebarResource;
use App\Repositories\RoomRepository;
use App\Repositories\TodoRepository;
use App\Traits\HTTPRepoResponseHandler;
use Exception;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    use HTTPRepoResponseHandler;

    protected $todoRepository, $roomRepository;

    function __construct(TodoRepository $todoRepository, RoomRepository $roomRepository)
    {
        $this->todoRepository = $todoRepository;
        $this->roomRepository = $roomRepository;
    }

    public function index(Request $request)
    {
        // get todo
        $todo_attr = [
            'organisation_id' => $request->org,
            'user_id' => $request->user
        ];

            // return response
        return response()->json(['message' => "success", "data" => $this->respondWithData($this->todoRepository->findWhere($todo_attr))], 200);
    }

    public function store(Request $request)
    {
        // create todo attr
        $todo_attr = [
            'organisation_id' => $request->org,
            'user_id' => $request->user,
            'owner' => $request->owner,
            'users' => $request->users,
            'title' => $request->title,
            'description' => $request->description,
            'created_at' => now(),
        ];

        // Create todo
        $result = $this->todoRepository->create($todo_attr);

        // check response
        if($result['status'] == 200 && isset($result["data"])){

            // create room attr
            $room_attr = [
                'todo_id' => $result["data"]["object_id"],
                'user_id' => $request->user,
                'organisation_id' => $request->org,
                'created_at' => now()
            ];

            // create room
            $result = $this->roomRepository->create($room_attr);

            // format response
            if($result["status"] == 200){

                // update todo
                $update_attr = ['room_id' => $result["data"]["object_id"]];
                $response = $this->todoRepository->update($room_attr['todo_id'], $update_attr);

                $response = ["message" => "Todo created"];
                return response()->json($response, 201);
            }
        }
        // return response
        return response()->json(['message' => $result['message']], 400);
    }

    public function delete(Request $request)
    {
        // delete todo attr
        $todo_attr = [
            'organisation_id' => $request->org,
            'user_id' => $request->user,
            'todo_id' => $request->todo_id
        ];

        // delete endpoint on zccore is not working as at the time this was written
        // so we'd update the task and add a deleted_at field to the column
        $update_attr = ['deleted_at' => now()];
        // update todo
        $this->todoRepository->update($todo_attr['todo_id'], $update_attr);
        // if update successful fetch room id from todo
        // delete from
        return response()->json(['message' => "Deleted"], 204);
    }

    public function sidebar(Request $request)
    {
        // get todo
        $room_attr = [
            'organisation_id' => $request->org,
            'user_id' => $request->user
        ];

        $responseFromRoom = $this->respondWithData($this->roomRepository->findWhere($room_attr));

        // the following code will try to fetch all the rooms the user belongs to ---
        // zuri core endpoints is not flexible enough
        // so we have to manually implement it
        $todosInRoom = array_column($responseFromRoom, 'todo_id'); //extract todo_id from room, we already have user_id


        // get all user todo
        $allUserTodos = $this->todoRepository->allWithoutDeletedWhere(['organisation_id' => $request->org,'user_id' => $request->user, 'owner' => 'user']);

        // get all admin todo
        $allAdminTodo = $this->todoRepository->allWithoutDeletedWhere(['organisation_id' => $request->org,'user_id' => $request->user, 'owner' => 'organisation']);

        // filter $allTodo and return only todo in $todosInRoom
        $filteredUserTodo = array_filter($allUserTodos,function ($v) use ($todosInRoom) {
            return in_array($v['_id'], $todosInRoom);
        });

        // filter $allTodo and return only todo in $todosInRoom
        $filteredAdminTodo = array_filter($allAdminTodo,function ($v) use ($todosInRoom, $room_attr) {
            return in_array($v['_id'], $todosInRoom) && in_array($room_attr['user_id'], $v['users']);
        });

        return response()->json(new SidebarResource(['public_rooms' => collect($filteredUserTodo), 'joined_rooms' => collect($filteredAdminTodo)]));
    }

    public function allRooms(Request $request)
    {
        $allTodos = $this->todoRepository->allWithoutDeletedWhere(['organisation_id' => $request->org]);
        return response()->json(['rooms' => $allTodos], 200);
    }

    public function usersInRoom(Request $request)
    {
        //Get the room we want to users from.
        //cookie passed from the client
        $usersInRoom = $this->todoRepository->allWithoutDeletedWhere(['organisation_id' => $request->org, 'room_id' => $request->room]);
        $data = [
            'token' => $request->token,
            'org' => $request->org
        ];

        $cookie = $request->server('HTTP_COOKIE');

        //IDs of all the users in a room
         //Get the users details
        $users_ids = $usersInRoom[0]['users'];
        $usersInfo = [];
        for ($i = 0; $i < count($users_ids); $i++) {
            $data['user_id'] = $users_ids[$i];

            $user = $this->todoRepository->findUser($data,  $cookie);
            if (isset($user['status'])) {
               $user = "user not found";
               continue;
            }
            $usersInfo[] = collect($user)->only(['display_name', 'email', 'first_name', 'last_name', 'phone']);
        }

        $response = !empty($usersInfo) ? $usersInfo : "users not found";
        return response()->json(["users" => $response], 200);

    }

    public function deleteRoom(Request $request)
    {
        return response()->json($this->roomRepository->delete($request->room_id));
    }
}
