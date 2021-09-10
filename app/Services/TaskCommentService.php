<?php

namespace App\Services;

use App\Repositories\TaskCommentRepository;

class TaskCommentService extends \App\Providers\AppServiceProvider
{
    protected $taskCommentRepository;

    public function __construct(TaskCommentRepository $taskCommentRepository)
    {
        $this->taskCommentRepository = $taskCommentRepository;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->taskCommentRepository->all();
    }

    public function commentsPerTask($key, $data)
    {
        return $this->taskCommentRepository->search($key, $data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->taskCommentRepository->create($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->taskCommentRepository->find($id);
    }

    /**
     * @author {Alpha2Chris14}
     */
    public function findTaskCommentById($id)
    {
        $whereArr = ['id' => $id];
        return $this->taskCommentRepository->findWhere($whereArr);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->taskCommentRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->taskCommentRepository->delete($id);
    }
}
