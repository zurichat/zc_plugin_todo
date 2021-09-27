<?php

namespace App\Helpers;


class Collaborator
{
    public static function isAdmin(array $todo, $userId): bool
    {
        $isAdmin = false;
        if ($todo['user_id'] == $userId) {
            $isAdmin = true;
        } else {
            foreach ($todo['colaborators'] as $collaborator) {
                if ($collaborator['admin_status'] == 1) {
                    $isAdmin = true;
                }
            }
        }

        return $isAdmin;
    }
}
