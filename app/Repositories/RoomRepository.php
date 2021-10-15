<?php

namespace App\Repositories;

use App\Repositories\Cache\CacheRepository;
use App\Repositories\HTTP\HTTPRepository;

class RoomRepository
{
    protected $modelName = 'TodoRoom';
    protected $httpRepository;
    protected $cacheRepository;

    public function __construct()
    {
        $this->httpRepository = new HTTPRepository($this->modelName);
        $this->cacheRepository = new CacheRepository($this->modelName);
    }
}
