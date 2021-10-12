<?php

namespace App\Repositories\Mail;

use Illuminate\Support\Facades\Http;

class mail
{

    protected $url = "https://api.zuri.chat/external/send-mail?custom_mail=1";

    public function sendMail(string $email, string $name)
    {
        $response = Http::post($this->url, [
            "email" => $email,
            "subject" => "MESSAGE FROM ZURI.CHAT",
            "content_type" => "text/html",
            "mail_body" => "<h1>Hey <b>$name</b></h1><br><p>You have just been added to collaborate on a todo. </p>Navigate to the workspace to view the todo"
        ]);

        return $response->json();
    }
}