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


    public function find($id, $user_id)
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
