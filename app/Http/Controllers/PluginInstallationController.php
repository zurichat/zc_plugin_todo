<?php

namespace App\Http\Controllers;

use App\Http\Requests\PluginInstallation\InstallRequest;
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
        $response = $this->pluginInstallationService->install($request->all());
        
        return response()->json($response);
    }
}
