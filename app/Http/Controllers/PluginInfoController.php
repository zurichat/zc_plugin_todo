<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PluginInfoController extends Controller
{
    // This method serves stactic info about the TO-DO plugin
    public function servePluginInfo()
    {

        $pluginInfo = [
            'name' => 'TODO Plugin',
            'description' => [
                "Zuri.chat Plugin",
                "A plugin to manage individual/team project's task"
            ],
            'scaffold_structure' => 'Monolith',
            'team' => 'HNG-8.0/Team-Kant',
            'ping_url' => 'https://todo.zuri.chat/api/ping',
            'html_url' => 'https://todo.zuri.chat/#/main',
            'sidebar_url' => 'https://todo.zuri.chat/#/main',
        ];
        return response()->json([
            'status' => 'success',
            'type' => 'plugin information',
            'plugin_info' => $pluginInfo
        ], 200);
    }
}
