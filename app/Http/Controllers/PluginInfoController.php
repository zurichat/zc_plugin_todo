<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PluginInfoController extends Controller
{
    public function servePluginInfo()
    {

        $pluginInfo = [
            'name' => 'TODO Plugin',
            'description' => [
                "Zuri.chat Plugin",
                "Todo Plugin is a zuri.chat plugin that can be used
                 to managing task for an individual or a team's project."
            ],
            'scaffold_structure' => 'Monolith',
            'team' => 'HNG-8.0/Team-Kant',
            'sidebar_url' => 'https://todo.zuri.chat/api/sidebar',
            'html_url' => 'https://todo.zuri.chat/',
            'ping_url' => 'https://todo.zuri.chat/api/ping',
        ];
        return response()->json([
            'status' => 'success',
            'type' => 'plugin information',
            'plugin_info' => $pluginInfo
        ], 200);
    }
}
