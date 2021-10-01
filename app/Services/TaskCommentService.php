<?php

namespace App\Services;

use App\Helpers\Response;
use App\Repositories\TaskCommentRepository;

class TaskCommentService extends TaskCommentRepository
{

    public function all()
    {
        return Response::checkAndServe($this->httpRepository->all());
    }

    public function commentsByKey(array $where)
    {
        return Response::checkAndServe($this->httpRepository->findWhere($where));
    }


    public function create(array $data)
    {
        return Response::checkAndServe($this->httpRepository->create($data));
    }


    public function find($id)
    {
        return Response::checkAndServe($this->httpRepository->find($id));
    }


    public function findTaskCommentById($id)
    {
        $whereArr = ['id' => $id];
        return Response::checkAndServe($this->httpRepository->findWhere($whereArr));
    }


    public function update($data, $id)
    {
        return Response::checkAndServe($this->httpRepository->update($id, $data));
    }


    public function delete($id)
    {
        return Response::checkAndServe($this->httpRepository->delete($id));
    }
}
