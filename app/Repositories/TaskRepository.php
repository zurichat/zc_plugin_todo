<?php

namespace App\Repositories;

use App\Repositories\Cache\CacheRepository;
use App\Repositories\HTTP\HTTPRepository;
use App\Repositories\Rtc\Centrifugo;

class TaskRepository extends Centrifugo
{
    protected $modelName = 'DemoTask';
    protected $httpRepository;
    protected $cacheRepository;

    public function __construct()
    {
        $this->httpRepository = new HTTPRepository($this->modelName);
        $this->cacheRepository = new CacheRepository($this->modelName);
use App\Repositories\HTTP\HTTPRepository;

class TaskRepository extends HTTPRepository
{
    protected $modelName = 'TodoDemoTask';

    public function __construct()
    {
        parent::__construct($this->modelName);
    }
}
