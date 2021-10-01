<?php

namespace App\Helpers;


class Response
{
    public static function checkAndServe($HTTPResponse)
    {
        if (isset($HTTPResponse["status"]) && $HTTPResponse['status'] == 200 && isset($HTTPResponse["data"]) && $HTTPResponse['data'] != null) {
            return $HTTPResponse["data"];
        }

        if (isset($HTTPResponse["data"]) && $HTTPResponse['data'] == null) {
            return [];
        }

        return $HTTPResponse;
    }

    public static function checkResponseStatus($HTTPResponse){
        if (isset($HTTPResponse["status"]) && $HTTPResponse['status'] == 200 && isset($HTTPResponse["data"]) && $HTTPResponse['data'] != null) {
            return true;
        }

        return false;
    }
}
 