<?php

namespace App\Services;

use App\Providers\AppServiceProvider;
use App\Repositories\TodoRepository;

class TodoService extends TodoRepository
{
    public function all()
    {
        return $this->httpRepository->all();
    }


    public function create(array $data)
    {
        return $this->httpRepository->create($data);
    }


    public function find($id)
    {
        return $this->httpRepository->find($id);
    }


    public function findBy($attr, $value)
    {
        return $this->httpRepository->findBy($attr, $value);
    }


    public function update($data, $id)
    {
        return $this->httpRepository->update($id, $data);
    }


    public function delete($id)
    {
        return $this->httpRepository->delete($id);
    }


    public function search($key, $data)
    {
        return $this->httpRepository->search($key, $data);
    }
}
