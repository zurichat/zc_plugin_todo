<?php

namespace App\Providers;

use App\Providers\SidebarEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\SidebarService;

class SidebarPublishListner
{
    protected $SidebarService;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SidebarService $SidebarService)
    {
        $this->SidebarService = $SidebarService;
    }

    public function shouldQueue(SidebarEvent $event)
    {
        return true;
    }

    /**
     * Handle the event.
     *
     * @param  SidebarEvent  $event
     * @return void
     */
    public function handle(SidebarEvent $event)
    {
        $this->SidebarService->sidebarAttr();
    }
}
