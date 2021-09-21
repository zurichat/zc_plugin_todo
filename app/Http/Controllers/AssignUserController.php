<?php

namespace App\Http\Controllers;

use App\Services\TodoService;
use Illuminate\Http\Request;

class AssignUserController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function assign(Request $request, $todoId)
    {
        $todo = $this->todoService->find($todoId);

        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }
        if ($request->colaborator_type == 'teams' || $request->colaborator_type == 'individuals') {
            $collabTypeExist = array_key_exists($request->colaborator_type, $todo['colaborators']);
            if (!$collabTypeExist) {
                $todo['colaborators'][$request->colaborator_type] = [$request->colaborator_id];
            }else{
                array_push($todo['colaborators'][$request->colaborator_type], $request->colaborator_id);
            }
            $this->todoService->update([
                'colaborators' => $todo['colaborators']
            ], $todoId);
            return response()->json('done');
        }else{
            return response()->json('Collaborator type must either be teams or individuals', 400);
        }


        // [
        //     "user_id" => $request->user_id,
        //     "channel_id" => "blank-for-now",
        //     "admin" => $request->admin_status
        // ];



        // $data = array();
        // $data['status_id'] = $task['status_id'];
        // $data['parent_id'] = $task['parent_id'];
        // $data['start_date'] = $task['start_date'];
        // $data['created_at'] = $task['created_at'];
        // $data['archived_at'] = $task['archived_at'];
        // $data['recurring'] = $task['recurring'];
        // $data['reminder'] = $task['reminder'];
        // $data['assigned_users'] = [];

        // $data['assigned_users'] = array_push($data['assigned_users'], $request->user_id);

        // $response = $this->taskService->update($data, $request->task_id);

        // return response()->json($response);
    }
    public function remove(Request $request, $todoId)
    {
        $todo = $this->todoService->find($todoId);
        
        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }
        // The type of colaborator is either teams or individuals
        if ($request->colaborator_type == 'teams' || $request->colaborator_type == 'individuals') {

            // Check if teams or individuals have been added to this particular todo
            $collabTypeExist = array_key_exists($request->colaborator_type, $todo['colaborators']);

            if (!$collabTypeExist) {
                return response()->json('There are no collaborators for this todo', 404);
            } else {

                // Request colaborators is an array of colaborators(incase of multiselect) so it'll search for the collaborators and delete them
                $count = 0;
                foreach ($request->colaborators as $colaborator) {

                    $key = array_search($colaborator,$todo['colaborators'][$request->colaborator_type]);
                    if($key !== false){
                        unset($todo['colaborators'][$request->colaborator_type][$key]);
                        $count++;
                    }
                    
                }
                $this->todoService->update([
                    'colaborators' => $todo['colaborators']
                ], $todoId);
                return response()->json("You have successfully deleted {$count} {$request->colaborator_type} from your todo - {$todo['title']}", 404);
            }
        } else {
            return response()->json('Collaborator type must either be teams or individuals', 400);
        }
    }
}
