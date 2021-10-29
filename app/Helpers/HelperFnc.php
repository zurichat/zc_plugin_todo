<?php

namespace App\Helpers;

use App\Http\Resources\SidebarResource;

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
            $query .= (string)$key . '=' . (string)$value . '&';
        }
        // return trimmed char
        return rtrim($query, '&');
    }

    public static function trimToken($token)
    {
        // data attr
        $token = explode(' ', $token);

        if (is_array($token) || count($token) > 1) {
            return $token[1];
        }
        return null;
    }

    public static function getRtcPayload(SidebarResource $dataText)
    {
        return [
            "name" => "Todo Plugin",
            "description" => "Todo Plugin sidebar",
            "group_name" => "Active Todos",
            "category" => "tools",
            "show_group" => false,
            "public_rooms" => $dataText["public_rooms"],
            "joined_rooms" => $dataText["joined_rooms"],
        ];
    }
}
