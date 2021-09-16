<?php

namespace App\Helpers;


class Response
{
    public static function checkAndServe($HTTPResponse)
    {
        if ($HTTPResponse['status'] == 200 && isset($HTTPResponse["data"])) {
            return $HTTPResponse["data"];
        }
        return $HTTPResponse;
    }
}
