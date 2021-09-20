<?php

namespace App\Repositories;

use App\Repositories\Cache\CacheRepository;
use App\Repositories\HTTP\HTTPRepository;
use App\Repositories\Rtc\Centrifugo;

class TodoRepository extends Centrifugo
{
    protected $modelName = 'Todo';
    protected $httpRepository;
    protected $cacheRepository;

    public function __construct()
    {
        $this->httpRepository = new HTTPRepository($this->modelName);
        $this->cacheRepository = new CacheRepository($this->modelName);
    }

    /**
     * Mark task as completed
     * This will change task status
     * 
     * @param string $task_id Task Id
     * 
     * @return mixed
     */
    public function markTaskCompleted($task_id)
    {
        $attributes = ['status' => 1];
        return $this->httpRepository->update($task_id, $attributes);
    }
}
