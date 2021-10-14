<?php

namespace App\Http\Controllers;

use App\Helpers\HelperFnc;
use App\Http\Requests\PluginInstallation\InstallRequest;
use App\Http\Requests\PluginInstallation\UninstallRequest;
use App\Services\PluginInstallationService;
use Illuminate\Http\Request;

class PluginInstallationController extends Controller
{
    protected $pluginInstallationService;

    function __construct(PluginInstallationService $pluginInstallationService)
    {
        $this->pluginInstallationService = $pluginInstallationService;
    }

    public function install(InstallRequest $request)
    {
        $data = $this->addTokenToAttribute($request);
        $response = $this->pluginInstallationService->install($data);
        
        return $response;
    }

    public function uninstall(UninstallRequest $request)
    {
        $data = $this->addTokenToAttribute($request);
        $response = $this->pluginInstallationService->uninstall($data);
        
        return $response;
    }

    public function addTokenToAttribute($request)
    {
        $rawToken = $request->header('Authorization');
        if(!$rawToken) abort(401, 'Authentication Error: TOKEN MISSING.');
        $token = HelperFnc::trimToken($rawToken);
        $data = $request->all();
        $data['token'] = $token;
        return $data;
    }
}
