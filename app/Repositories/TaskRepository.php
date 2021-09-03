<?php

namespace App\Repositories;

use App\Repositories\HTTP\HTTPRepository;

class TaskRepository extends HTTPRepository
{
    protected $modelName = 'TodoDemoTask';

    public function __construct()
    {
        parent::__construct($this->modelName);
    }
}
