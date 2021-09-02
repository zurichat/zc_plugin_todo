<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SideBarItemsController extends Controller
{
    public function serveMenuItems()
    {
        $sideBarMenu = [
            'title' => 'TODO',
            'sub_menu' => [
                'item_1' => [
                    'name' => 'Task Board',
                    'icon' => 'https://media.publit.io/file/board.svg',
                    'action' => 'Open Task Board'
                ],

                'item_2' => [
                    'name' => 'Schedule',
                    'icon' => 'https://media.publit.io/file/schedulem.svg',
                    'action' => 'Schedule Task'
                ],

                'item_3' => [
                    'name' => 'Calender',
                    'icon' => 'https://media.publit.io/file/calendar-page-with-circular-clock-symbol-svgrepo-com.svg',
                    'action' => 'Open Task calendar'
                ],

                'item_4' => [
                    'name' => 'Search',
                    'icon' => '#',
                    'action' => 'Open Search Bar'
                ],

                'item_5' => [
                    'name' => 'Inbox',
                    'icon' => '#',
                    'action' => 'Open Inbox'
                ]
            ]

        ];

        return response()->json([
            'status' => 'success',
            'plugin_name' => 'TODO Plugin',
            'type' => 'sidebar items',
            'menu' => $sideBarMenu
        ], 200);
    }
}
