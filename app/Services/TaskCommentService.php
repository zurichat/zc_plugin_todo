<?php

namespace App\Services;

use App\Helpers\Response;
use App\Repositories\TaskCommentRepository;
use App\Services\ServiceTrait;

class TaskCommentService extends TaskCommentRepository
{
    Use ServiceTrait;
    
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

    public function commentsPerTask($key, $data)
    {
        return Response::checkAndServe($this->httpRepository->search($key, $data));
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


    public function findTaskCommentById($id)
    {
        $whereArr = ['id' => $id];
        return Response::checkAndServe($this->httpRepository->findWhere($whereArr));
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
}
