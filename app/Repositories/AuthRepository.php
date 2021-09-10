<?php

namespace App\Repositories;

use App\Repositories\HTTP\HTTPRepository;

class AuthRepository extends HTTPRepository
{
    public function authenticateUser($data)
    {
        return $this->model::withHeaders(['Authorization' => 'Bearer ' . $data['token']])->get($this->url . '/users/' . $data['user_id'])->json();
    }
}
