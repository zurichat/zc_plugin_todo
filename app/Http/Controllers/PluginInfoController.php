<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PluginInfoController extends Controller
{
    public function servePluginInfo()
    {

        $pluginInfo = [
            'name' => 'TODO Plugin',
            'description' => "Zuri.chat Plugin",
            'scaffold_structure' => 'Monolith',
            'use' => "Set and Manage individual/team Project's Tasks",
            'team' => 'HNG-8.0/Team-Kant',
            'team_lead' => 'Bethel Irumudomon',
            'mvp_features' => [
                'feature-1' => 'Create Todo Tasks',
                'feature-2' => 'Assign Tasks To An Individual Or A Team',
                'feature-3' => 'Manage and Display Task Progress Using Dynamic ProgressBar',
                'feature-4' => "Set Reminders For Task's Due Date",
                'feature-5' => "Schedule A Task For Future Commencement",
                'feature-6' => 'Schedule Task Notification And Reminders',
                'feature-7' => 'Manage Workspace Comments On Task'
            ],
            'programming_language' => ['PHP', 'Javascript'],
            'frameworks' => ['Laravel', 'Vue.js'],
            'dependencies' => ['Phpredis', 'Tailwind CSS',]
        ];
        return response()->json([
            'status' => 'success',
            'type' => 'plugin information',
            'plugin_info' => $pluginInfo
        ], 200);
    }
}
