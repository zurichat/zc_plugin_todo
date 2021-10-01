<?php

namespace App\Helpers;


class Response
{
    public static function checkAndServe($HTTPResponse)
    {
        // if ($HTTPResponse['status'] == 200 && isset($HTTPResponse["data"]) && $HTTPResponse['data'] != null) {
        //     return $HTTPResponse["data"];
        // }

        // if ($HTTPResponse['data'] == null) {
        //     return [];
        // }

        return $HTTPResponse;
    }
}
