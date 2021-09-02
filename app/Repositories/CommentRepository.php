<?php

namespace App\Repositories;

use App\Repositories\HTTP\HTTPRepository;

class CommentRepository extends HTTPRepository
{
    protected $modelName = 'comments';

    public function __construct()
    {
        parent::__construct($this->modelName);
    }
}
