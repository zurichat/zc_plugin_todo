<?php

namespace App\Services;

use App\Helpers\Response;
use App\Repositories\TaskRepository;
//use App\Services\ServiceTrait;

class TaskService extends TaskRepository
{
    use ServiceTrait;
    /**
     * @return mixed
     */
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

    /**
     * @param array $data
     * @return mixed
     */
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

    /**
     * @param int $id
     * @return mixed
     */
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

    /**
     * @param mixed
     * @return mixed
     */
    public function findBy($attr, $value)
    {
        return Response::checkAndServe($this->httpRepository->findBy($attr, $value));
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
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

    /**
     * @param int $id
     * @return mixed
     */
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

}
