<?php

namespace App\Services;

use App\Helpers\Response;
use App\Providers\AppServiceProvider;
use App\Repositories\TodoRepository;

class TodoService extends TodoRepository
{
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


    public function findBy($attr, $value)
    {
        return Response::checkAndServe($this->httpRepository->findBy($attr, $value));
    }


    public function update($data, $id)
    {
        return Response::checkAndServe($this->httpRepository->update($id, $data));
    }


    public function delete($id)
    {
        return Response::checkAndServe($this->httpRepository->delete($id));
    }

  /**
     * This will search with a specif key-value pair
     */
    public function search($key, $data)
    {
        $objects = $this->all();
        if (isset($objects['status'])) {
            return ["status" => "error"];
        }
        $search_data = collect($objects)->map(function($todo) use($data, $key) {
            if(strtolower($todo[$key]) == strtolower($data)){
                return $todo;
            }
        })->reject(fn($todo) => empty($todo))->values();

        return $search_data;
    }
}
