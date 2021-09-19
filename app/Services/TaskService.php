<?php

namespace App\Services;

use App\Helpers\Response;
use App\Repositories\TaskRepository;

class TaskService extends TaskRepository
{
    /**
     * @return mixed
     */
    public function all()
    {
        return Response::checkAndServe($this->httpRepository->all());
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
        return Response::checkAndServe($this->httpRepository->findBy($attr, $value));
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

}
