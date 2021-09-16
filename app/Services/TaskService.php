<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService extends TaskRepository
{
    /**
     * @return mixed
     */
    public function all()
    {
        return $this->httpRepository->all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->httpRepository->create($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->httpRepository->find($id);
    }

     /**
     * @param mixed
     * @return mixed
     */
    public function findBy($attr, $value)
    {
        return $this->httpRepository->findBy($attr, $value);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->httpRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->httpRepository->delete($id);
    }

    public function showResource()
    {
        return $this->httpRepository->all();
    }
          /**
     * @return mixed
     * @author {@omoh}
     */
    public function getLatestTask()
    {
        $result = $this->httpRepository->all();
        $data = [];
        // filter the array for items without created_at
        foreach($result as $anyName){
            if(isset($anyName['created_at'])){
                array_push($data,$anyName);
            }
        }
        $collection = collect($data);
        $sorted = $collection->sortDesc()->first();
        return $sorted;
    }

    /**
     * This will search for a models with a specif key-value pair
     */
    public function search($key, $data)
    {
        $objects = $this->all();
        if (isset($objects['status']) && $objects['status'] == '404') {
            return ["status" => "error"];
        }
        $search_data = [];
        for ($i = 0; $i < count($objects); $i++) {
            if (strtolower($objects[$i][$key]) == strtolower($data)) {
                array_push($search_data, $objects[$i]);
            }
        }
        return $search_data;
    }



}
