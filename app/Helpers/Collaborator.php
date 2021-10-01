<?php

namespace App\Helpers;


class Collaborator
{
    public static function isAdmin(array $todo, $userId): bool
    {
        $isAdmin = false;
        // dd($todo);
        if ($todo['user_id'] == $userId) {
            $isAdmin = true;
        } else {
            foreach ($todo['collaborators'] as $collaborator) {
                if ($collaborator['admin_status'] == 1) {
                    $isAdmin = true;
                }
            }
        }

        return $isAdmin;
    }

    public static function haveAccess(array $todo, $userId): bool
    {
        $haveAccess = false;
        if ($todo['user_id'] == $userId) {
            $haveAccess = true;
        } else {
            foreach ($todo['collaborators'] as $collaborator) {
                if ($collaborator['user_id'] == $userId) {
                    $haveAccess = true;
                }
            }
        }

        return $haveAccess;
    }

    public static function isCreator(array $comment, $userId): bool
    {
        return $comment['user_id'] == $userId ? true : false;
    }
}
