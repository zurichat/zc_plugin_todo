<?php

namespace App\Models;



class Collaborator
{
    protected $user_id;
    protected $admin_status;

    public function __construct(string $user_id, string $admin_status)
    {
        $this->user_id = $user_id;
        $this->admin_status = $admin_status;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getAdminStatus()
    {
        return $this->admin_status;
    }
}
