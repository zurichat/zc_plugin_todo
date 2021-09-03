<?php

namespace App\Repositories;

use App\Repositories\HTTP\HTTPRepository;

class TaskCommentRepository extends HTTPRepository
{
    protected $modelName = 'TodoTaskComment';

    public function __construct()
    {
        parent::__construct($this->modelName);
    }
}
