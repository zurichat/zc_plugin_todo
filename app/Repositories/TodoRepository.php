<?php

namespace App\Repositories;

use App\Repositories\HTTP\HTTPRepository;

class TodoRepository extends HTTPRepository
{
    protected $modelName = 'DemoTodo';

    public function __construct()
    {
        parent::__construct($this->modelName);
    }
}
