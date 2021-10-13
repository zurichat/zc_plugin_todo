<?php

namespace App\Services;

use App\Repositories\PluginInstallationRepository;
use Illuminate\Support\Facades\Config;

class PluginInstallationService
{
    protected $repository;

    protected $token;

    function __construct(PluginInstallationRepository $repository)
    {
        $this->repository = $repository;
        $this->token = Config::get('token');
    }

    public function install($data)
    {
        $data = $this->updateDataIfTokenSet($data);

        return $this->repository->installPluginOnWorkspace($data);
    }

    public function uninstall($data)
    {
        $data = $this->updateDataIfTokenSet($data);

        return $this->repository->uninstallPluginFromWorkspace($data);
    }

    private function isTokenSet(){

        if(!$this->token){
            abort(401, 'Authentication Error: TOKEN MISSING.');
        }
    }

    private function updateDataArray(array $data, $token){
        
        $data['token'] = $token;
        $data['plugin_id'] = Config::get('plugin_id');

        return $data;
    }

    private function updateDataIfTokenSet($data)
    {
        if ($this->isTokenSet()) {
            return $this->updateDataArray($data, $this->token);
        }
    }
}
