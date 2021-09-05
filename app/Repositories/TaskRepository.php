<?php

namespace App\Repositories;

use App\Repositories\HTTP\HTTPRepository;

class TaskRepository extends HTTPRepository
{
    protected $modelName = 'DemoTask';

    public function __construct()
    {
        parent::__construct($this->modelName);
    }
}
