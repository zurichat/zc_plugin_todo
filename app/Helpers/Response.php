<?php

namespace App\Helpers;

use App\Constants\AppConstants;

class Response
{
    public static function checkAndServe($HTTPResponse)
    {

        if (isset($HTTPResponse["status"]) && $HTTPResponse['status'] === 200 && isset($HTTPResponse["data"]) && $HTTPResponse['data'] != null) {
            // Everything is ok, return the returned data
            return $HTTPResponse["data"];
        } elseif ($HTTPResponse['status'] == 200 && isset($HTTPResponse["message"]) && $HTTPResponse['data'] === null) {

            // Request went through but could not find the  requested resource for the
            // user or the organizarion
            return ['status' => AppConstants::MSG_200, 'data' => null];
        } elseif (isset($HTTPResponse["status"]) && $HTTPResponse['status'] != 200) {
            // Something went wrong during the 
            return ['error' => AppConstants::MSG_500, 'error_data' => $HTTPResponse];
        } else {
            return $HTTPResponse;
        }
    }

    public static function checkResponseStatus($HTTPResponse)
    {
        if (isset($HTTPResponse["status"]) && $HTTPResponse['status'] == 200 && isset($HTTPResponse["data"]) && $HTTPResponse['data'] != null) {
            return true;
        }

        return false;
    }

    public static function checkAndServeComment($HTTPResponse)
    {
        return $HTTPResponse == null ? [] : $HTTPResponse;
    }
}
