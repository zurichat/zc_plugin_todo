<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SideBarItemsController extends Controller
{
    public function serveMenuItems()
    {
        $sideBarItems = [
            'item_1' => 'Task Leaf',
            'item_2' => 'Schedules',
            'item_3' => 'Calendar'
        ];

        return response()->json([
            'status' => 'success',
            'type' => 'sidebar items',
            'items' => $sideBarItems
        ], 200);
    }
}
