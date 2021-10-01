<?php

namespace App\Services;

use App\Helpers\Response;
use App\Providers\AppServiceProvider;
use App\Repositories\TodoRepository;
use Illuminate\Routing\ResponseFactory;

//use App\Services\ServiceTrait;

class TodoService extends TodoRepository
{
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


    public function update($data, $id)
    {
        //update cache before updating
        if($this->cacheRepository->all() == []){  
            //update cache
            $this->fetchDataFromServer();
        }

        //check if cache exist else get from server and update cache
        $response = $this->httpRepository->update($id, $data); 
        
        if (isset($response['data']['modified_documents']) && $response['data']['modified_documents'] >= 0) {
            $this->cacheRepository->update($id, $data);
            
            return Response::checkAndServe($response);
        }
        
        return Response::checkAndServe($response);
        //return Response::checkAndServe($this->httpRepository->update($id, $data));
    }


    public function delete($id)
    {
        //check if cache exist else get from server and delete object from cache
        $response = $this->httpRepository->delete($id); 
        
        if (($response['status'] == 200 || $response['status'] == "success") && isset($response["data"])) {
            $this->cacheRepository->delete($id);
            
            return Response::checkAndServe($response['data']);
        }
        
        return Response::checkAndServe($response);
        //return Response::checkAndServe($this->httpRepository->delete($id));
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
