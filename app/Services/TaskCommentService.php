<?php

namespace App\Services;

use App\Helpers\Response;
use App\Repositories\TaskCommentRepository;
use App\Services\ServiceTrait;

class TaskCommentService extends TaskCommentRepository
{
    use ServiceTrait;

    public function all()
    {

        return Response::checkAndServe($this->httpRepository->all());
    }

    public function commentsPerTask($taskId)
    {
        return Response::checkAndServe($this->httpRepository->findBy('task_id', $taskId));
    }

    public function commentsByKey(array $where)
    {
        return Response::checkAndServeComment($this->httpRepository->findWhere($where));
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
