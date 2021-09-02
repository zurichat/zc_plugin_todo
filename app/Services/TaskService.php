<?php

namespace App\Services;

use App\Repositories\Cache\CacheRepository;
use App\Repositories\Cache\TaskCacheRepository;
use App\Repositories\HTTP\HTTPRepository;
use App\Repositories\TaskRepository;

class TaskService extends \App\Providers\AppServiceProvider
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
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

      /**
     * @return mixed
     * @author {@omoh}
     */
    public function getLatestTask()
    {
        $result = $this->taskRepository->all();
        $data = $result['data'][0];
        return $data;
    }

    /**
     * @para mixed $data
     *  return mixed
     */
    public function search($key, $data)
    {
        return $this->taskRepository->search($key, $data);
    }
}
