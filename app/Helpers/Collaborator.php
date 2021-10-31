<?php

namespace App\Helpers;

use App\Mail\TaskAddedMail;
use App\Services\UserService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Collaborator
{

    public static function isAdmin(array $todo, $userId): bool
    {
        $isAdmin = false;

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
    public static function listAllUsersInTodo(array $todo)
    {
        $users = [];
        if (isset($todo['collaborators'])) {
            foreach ($todo['collaborators'] as $collaborator) {
                array_push($users, $collaborator['user_id']);
            }
        }
        array_push($users, $todo['user_id']);
        return $users;
    }
    public function sendMails(array $user_ids, $subject, $message)
    {
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $bearerToken = $_SERVER['HTTP_AUTHORIZATION'];
            for ($i = 0; $i < count($user_ids); $i++) {
                # code...
                $data['user_id'] = $user_ids[$i];
                $user = $this->findUser($data, $bearerToken);
                // Log::info($user['email'])
                $this->sendMail($user, $subject, $message);
            }
        }
    }
    public function sendMail($user, $subject, $message)
    {
        $res = Http::post('https://api.zuri.chat/external/send-mail?custom_mail=1', [
            'email' => $user['email'],
            'subject' => $subject,
            "content_type" => "text/plain",
            "mail_body" => $message,
        ]);
        return $res->json();
    }

    public static function sortAdminFirst(array $collaborators): array
    {
        $adminFirstList = [];

        foreach ($collaborators as $collaborator) {
            if ($collaborator['admin_status'] == 1) {
                array_unshift($adminFirstList, $collaborator);
            } else {
                array_push($adminFirstList, $collaborator);
            }
        }

        return $adminFirstList;
    }
    public function findUser($data, $bearerToken)
    {
        return $this->httpRepository->findUser($data, $bearerToken);
    }
}
