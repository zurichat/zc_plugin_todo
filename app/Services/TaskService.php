<?php

namespace App\Services;

use App\Contracts\TaskRepository;
use App\Repositories\Cache\TaskCacheRepository;
use App\Repositories\HTTP\TaskHTTPRepository;

class TaskService extends \App\Providers\AppServiceProvider
{
    /**
     * @var TaskRepository
     */
    protected $taskRepository;

    public function __construct(TaskHTTPRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->taskRepository->all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->taskRepository->create($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->taskRepository->find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->taskRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->taskRepository->delete($id);
    }
}
