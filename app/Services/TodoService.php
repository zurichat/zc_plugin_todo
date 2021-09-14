<?php

namespace App\Services;

use App\Providers\AppServiceProvider;
use App\Repositories\TodoRepository;

class TodoService extends AppServiceProvider
{

    protected $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function all()
    {
        return $this->todoRepository->all();
    }


    public function create(array $data)
    {
        return $this->todoRepository->create($data);
    }


    public function find($id)
    {
        return $this->todoRepository->find($id);
    }


    public function findBy($attr, $value)
    {
        return $this->todoRepository->findBy($attr, $value);
    }


    public function update($data, $id)
    {
        return $this->todoRepository->update($id, $data);
    }


    public function delete($id)
    {
        return $this->todoRepository->delete($id);
    }


    public function search($key, $data)
    {
        return $this->todoRepository->search($key, $data);
    }
}
