<?php

namespace App\Repositories;

use App\Repositories\HTTP\HTTPRepository;

class RoomRepository extends HTTPRepository
{
    protected $modelName = 'DemoTodoRoom';

    public function __construct()
    {
        parent::__construct($this->modelName);
    }
}
