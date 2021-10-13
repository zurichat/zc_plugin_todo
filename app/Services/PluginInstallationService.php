<?php

namespace App\Services;

use App\Repositories\PluginInstallationRepository;
use Illuminate\Support\Facades\Config;

class PluginInstallationService
{
    protected $repository;

    function __construct(PluginInstallationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function install($data)
    {
        if(!$token = Config::get('token')){
            abort(401, 'Authentication Error: TOKEN MISSING.');
        }

        $data['token'] = $token;

        return $this->repository->installPluginOnWorkspace($data);
    }

    public function uninstall($data)
    {
        if(!$token = Config::get('token')){
            abort(401, 'Authentication Error: TOKEN MISSING.');
        }

        $data['token'] = $token;

        return $this->repository->uninstallPluginFromWorkspace($data);
    }
}
