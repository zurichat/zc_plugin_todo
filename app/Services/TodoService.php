<?php

namespace App\Services;

use Carbon\Carbon;
use App\Helpers\Response;
use App\Repositories\TodoRepository;
use App\Providers\AppServiceProvider;
use App\Services\ServiceTrait;

class TodoService extends TodoRepository
{
    //use ServiceTrait;
    public function all()
    {
        
        return Response::checkAndServe($this->httpRepository->all());
    }


    public function create(array $data)
    {
        
        return Response::checkAndServe($this->httpRepository->create($data));
    }

    public function find($id)
    {
        return Response::checkAndServe($this->httpRepository->find($id));
    }

    public function findTodo($id, $user_id)
    {
        $todo =  Response::checkAndServe($this->httpRepository->findWhere(['_id' => $id, 'user_id' => $user_id]));
        if (isset($todo['data']) && $todo['data'] == null) {
            abort(404, "Todo not found");
        }
        return $todo;
    }


    public function findBy($attr, $value)
    {
        return Response::checkAndServe($this->httpRepository->findBy($attr, $value));
    }

    public function findWhere($whereArray){
        return Response::checkAndServe($this->httpRepository->findWhere($whereArray));
    }


    public function updateTodo($data, $todoId, $user_id)
    {
        $todo = $this->findWhere(['_id' => $todoId]);

        //Throw an exception if todo is not found
        abort_if(isset($todo['data']) && $todo['data'] == null, 404, "Todo not found or empty");

        if ($todo['user_id'] != $user_id) {
            abort("You dont have authorization to delete", 401);
        }
        abort_if(empty($data), 400, "Request payload is empty");
        $update = $this->update($data, $todoId);

        if(isset($update['modified_documents']) && $update['modified_documents'] > 0){
           $response = ['message' => 'Todo updated successfully', 'data' => $update];
        }else {
            abort(500, 'an error was encountered');
        }
        return $response;
    }

    public function update($data, $todoId)
    {
        return Response::checkAndServe($this->httpRepository->update($todoId, $data));
    }

    public function delete($todoId, $user_id)
    {
        $todo = $this->findWhere(['_id' => $todoId]);
        //check if the Todo is found
        //if not Throw exception
        if (isset($todo['data']) && $todo['data'] == null) {
            abort(404, "Todo not found");
        }
        //if the user that is trying to delete is not the user that created, no one else can delete
        abort_if($todo['user_id'] != $user_id, 401, "You dont have authorization to delete");

        $deleted_at = ['deleted_at' => Carbon::now()];
        $update = $this->update($deleted_at, $todoId);

        $response = (isset($update['modified_documents']) && $update['modified_documents'] > 0) ? ['message' => 'Todo deleted successfully'] : ['error'=> 'an error was encountered'] ;
        return $response;
    }

  /**
     * This will search with a specif key-value pair
     */
    public function search($key, $data, $user_id)
    {
        $objects = $this->httpRepository->findWhere([$key => $data, 'user_id' => $user_id]);

        if (isset($objects['status']) && $objects['status'] == '404') {
            return ["status" => "error"];
        }
        $search_data = collect($objects['data'])->map(function($todo) use($data, $key) {
            if(strtolower($todo[$key]) == strtolower($data)){
                return $todo;
            }
        })->reject(fn($todo) => empty($todo))->values();

        return $search_data;
    }

    /**
     * Check if todo is archived
     */
    public static function isTodoArchived($item)
    {
        // check if key exist
        if(isset($item['archived_at'])){
            // if key exist, check if key is null
            // if null, todo is not archived
            // else todo is archived
            return $item['archived_at'] == null ? false : true;
        }
        // if key does not exist
        // todo is not archived
        return false;
    }

    /**
     * Check if todo is deleted
     */
    public static function isTodoDeleted($item)
    {
        // check if key exist
        if(isset($item['deleted_at'])){
            // if key exist, check if key is null
            // if null, todo is not deleted
            // else todo is deleted
            return $item['deleted_at'] == null ? false : true;
        }
        // if key does not exist
        // todo is not deleted
        return false;
    }
}