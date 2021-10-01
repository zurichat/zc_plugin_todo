<?php

namespace App\Services;

use Carbon\Carbon;
use App\Helpers\Response;
use App\Repositories\TodoRepository;

use App\Services\ServiceTrait;
use App\Providers\AppServiceProvider;
class TodoService extends TodoRepository{
    use ServiceTrait;

    public function all()
    {
        if($this->cacheRepository->all() == []){
            
            //update cache
            $this->fetchDataFromServer();

            $response = $this->httpRepository->all();
            
            if (Response::checkResponseStatus($response)) {
                $this->cacheRepository->create($response['data']);
            }

            return Response::checkAndServe($response);
        }

        return $this->cacheRepository->all();
        //return Response::checkAndServe($this->httpRepository->all());
    }


    public function create(array $data)
    {
        //update cache before creating
        if($this->cacheRepository->all() == []){  
            //update cache
            $this->fetchDataFromServer();
        }

        $response = $this->httpRepository->create($data); 
        // check if response can be cache
        if (Response::checkResponseStatus($response)) {

            $object = array_merge(['_id' => $response["data"]['object_id']], $data);
            //cache response
            $this->cacheRepository->create($object);
            // return response
            return $response['data'];

        }
        
        return Response::checkAndServe($response);
        //return Response::checkAndServe($this->httpRepository->create($data));
    }

    public function find($id)
    {
        //check if cache is empty else fech from server and save to cache
        if($this->cacheRepository->find($id) == []){

            $this->fetchDataFromServer();
            // fetch data from server
            $response = $this->httpRepository->find($id);
            
            //cache successful response
            if (Response::checkResponseStatus($response)) {
                $this->cacheRepository->create($response['data']);
            }
            
            // return response data
            return $response['data'];
        }
        
        //return response
        return $this->cacheRepository->find($id);
        //return Response::checkAndServe($this->httpRepository->find($id));
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
        $update = $this->update($todoId, $data);

        if(isset($update['modified_documents']) && $update['modified_documents'] > 0){
           $response = ['message' => 'Todo updated successfully', 'data' => $update];
        }else {
            abort(500, 'an error was encountered');
        }
        return $response;
    }

    public function update($todoId, $data)
    {
        //update cache before updating
        if($this->cacheRepository->all() == []){  
            //update cache
            $this->fetchDataFromServer();
        }

        //check if cache exist else get from server and update cache
        $response = $this->httpRepository->update($todoId, $data); 
        
        if (isset($response['data']['modified_documents']) && $response['data']['modified_documents'] >= 0) {
            $this->cacheRepository->update($todoId, $data);
            
            return $response['data'];
        }
        
        return $response['data'];
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
        if ($todo['user_id'] != $user_id) return response()->json("You dont have authorization to delete", 401);

        $deleted_at = ['deleted_at' => Carbon::now()];
        $update = $this->update($todoId, $deleted_at);

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
