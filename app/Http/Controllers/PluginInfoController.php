<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PluginInfoController extends Controller
{
    public function servePluginInfo()
    {

        $pluginInfo = [
            'name' => 'TODO Plugin',
            'description' => "Zuri.chat Plugin for TODO tasks management\n. 
                              Plugin can create and assigne\n task to an individuaal
                              or a team",
            'scaffold_structure' => 'Monolith',
            'use' => "Set and Manage individual/team Project's Tasks",
            'team' => 'HNG-8.0/Team-Kant',
            'sidebar_url' => 'https://todo.zuri.chat/api/sidebar',
            'url' => 'https://todo.zuri.chat/',
            'ping_url' => 'https://todo.zuri.chat/api/ping',
        ];
        return response()->json([
            'status' => 'success',
            'type' => 'plugin information',
            'plugin_info' => $pluginInfo
        ], 200);
    }
}
