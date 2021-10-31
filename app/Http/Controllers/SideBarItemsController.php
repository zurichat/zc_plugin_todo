<?php

namespace App\Http\Controllers;

use App\Http\Resources\SidebarResource;
use App\Services\TodoService;
use App\Services\UserService;
use App\Services\SidebarService;
use Illuminate\Support\Facades\Config;

class SideBarItemsController extends Controller
{
    /**
     * sidebarService
     *
     * @var sidebarService
     */
    protected $sidebarService;

    /**
     * __construct
     *
     * @param  SidebarService $sidebarService
     * @return void
     */
    public function __construct(SidebarService $sidebarService)
    {
        $this->SidebarService = $sidebarService;
    }

    public function sidebar()
    {
        return $this->SidebarService->sidebar('json');
    }

    public function sidebarRTC()
    {
        return $this->SidebarService->sidebar(null);
    }

}
