<?php

namespace App\Repositories;

use App\Repositories\HTTP\HTTPRepository;

class PluginInstallationRepository extends HTTPRepository
{
    public function installPluginOnWorkspace($data)
    {
        return $this->model::withHeaders(['Authorization' => 'Bearer ' . $data['token']])->post($this->url . '/organizations/' . $data['organisation_id']. '/plugins', $data)->json();
    }
}
