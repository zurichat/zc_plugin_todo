<?php

namespace App\Services;

use Carbon\Carbon;
use App\Helpers\Sort;
use App\Helpers\Response;
use App\Helpers\Collaborator;
use App\Repositories\TaskRepository;

class TaskService extends TaskRepository
{
    /**
     * @return mixed
     */
    public function all()
    {
        $task = Response::checkAndServe($this->httpRepository->all());
        abort_if(isset($task['status']) && $task['status'] == '404', 200, 'Tasks not found');
        return $task;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return Response::checkAndServe($this->httpRepository->create($data));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        return Response::checkAndServe($this->httpRepository->find($id));
    }

    /**
     * @param mixed
     * @return mixed
     */
    public function findBy($attr, $value)
    {
        $task = Response::checkAndServe($this->httpRepository->findBy($attr, $value));
        abort_if(empty($tasks), 200, "Todo not found");
        return $task;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return Response::checkAndServe($this->httpRepository->update($id, $data));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return Response::checkAndServe($this->httpRepository->delete($id));
    }

    public function showResource()
    {
        return Response::checkAndServe($this->httpRepository->all());
    }
    /**
     * @return mixed
     * @author {@omoh}
     */
    public function getLatestTask()
    {
        $result = Response::checkAndServe($this->httpRepository->all());
        if (isset($result['status']) && $result['status'] == 404) {
            return $result;
        }

        $data = [];
        // filter the array for items without created_at
        foreach ($result as $anyName) {
            if (isset($anyName['created_at'])) {
                array_push($data, $anyName);
            }

            $collection = collect($data);
            $sorted = $collection->sortDesc()->first();
            return $sorted;
        }
    }

    /**
     * @param string
     * @return mixed
     */
    public function toggleStatus($id)
    {
        $task = $this->find($id); // Get the Task

        $archived = array_key_exists('archived_at', $task) && $task['archived_at']  ?  '' : Carbon::now(); // Set new date if it is null or empty, else set back to empty

        // prepare the payload
        $data = array();
        $data['archived_at'] = $archived;

        //response from zccore
        return response()->json($this->update($data, $id));
    }

    public function taskCategory($request)
    {
         // Search for the category
         $allTasks = $this->all();
         Sort::sortAll($request);

         $newArr = [];
         foreach ($allTasks as $value) {
             if (isset($value['category_id']) && $value['category_id'] == $request->category_id) {
                 array_push($newArr, $value);
             }
         }

         return $newArr;
    }

    public function taskCollection($request)
    {
        $allTasks = $this->all();
        Sort::sortAll($request);

        $sort = $request->order;
        if ($sort){
        $allTasks = collect($allTasks->sortBy('created_at'))->toArray;
        }

        $time = time();
        $arr = array();
        foreach ($allTasks as $value) {
            if (array_key_exists('end_date', [$value])) {
                $end_date = $value['end_date'];
                $convert_date = strtotime($end_date);
                if ($convert_date >= $time) {

                    $arr = $value;
                }
            }
        }
        return $arr;
    }

    public function sort($request)
    {
        $parameter = $request->sort;
        $tasks = $this->all();
        $collectionTasks = collect($tasks)->sortBy($parameter);
        return $collectionTasks;
    }

    public function MarkTask($request, $todoId)
    {
        // inialize value for task
        $todo = $this->findBy('_id', $todoId);
        if (isset($todo['status']) && $todo['status'] == 404) {
            return response()->json($todo, 404);
        }
        for ($i = 0; $i < count($todo['tasks']); $i++) {
            if ($todo['tasks'][$i]['task_id'] == $request->task_id) {
                $todo['tasks'][$i]['status'] = $request->status;
            }
        }

        unset($todo['_id']);

        $result = $this->todoService->update($todo, $todoId);
        if (isset($result['modified_documents']) && $result['modified_documents'] > 0) {
            $todoWithId = array_merge(['_id' => $todoId], $todo);
            $this->publishToRoomChannel($todo['channel'], $todoWithId, 'todo', 'update');

            // Send Mail
            $user_ids = Collaborator::listAllUsersInTodo($todo);
            $collab = new Collaborator;
            $collab->sendMails($user_ids, 'Task Added', 'A task with the title' . $request->title . 'has been marked in the todo');
            return $todoWithId;
        } else {
           abort(500, $result);
        }
    }
}
