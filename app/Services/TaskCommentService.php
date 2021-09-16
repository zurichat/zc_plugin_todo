<?php

namespace App\Services;

use App\Helpers\Response;
use App\Repositories\TaskCommentRepository;

class TaskCommentService extends TaskCommentRepository
{
    /**
     * @return mixed
     */
    public function all()
    {
        return Response::checkAndServe($this->httpRepository->all());
    }

    public function commentsPerTask($key, $data)
    {
        return Response::checkAndServe($this->httpRepository->search($key, $data));
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
     * @author {Alpha2Chris14}
     */
    public function findTaskCommentById($id)
    {
        $whereArr = ['id' => $id];
        return Response::checkAndServe($this->httpRepository->findWhere($whereArr));
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
}
