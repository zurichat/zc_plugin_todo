<?php

namespace App\Helpers;

class HelperFnc
{
    /**
     * Build HTML get param string
     */
    public static function queryBuilder(array $where)
    {
        // empty string var
        $query = "";
        // build query
        foreach ($where as $key => $value) {
            $query .= (string)$key.'='.(string)$value.'&';
        }
        // return trimmed char
        return rtrim($query, '&');
    }    

    public static function trimToken($token)
    {
        // data attr
        $token = explode(' ', $token);

        if(is_array($token) || count($token) > 1){
            return $token[1];
        }
        return null;
    }
}
