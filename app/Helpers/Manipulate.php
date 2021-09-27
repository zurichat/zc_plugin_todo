<?php

namespace App\Helpers;


class Manipulate
{
    public static function buildChannel(string $name, string $uuid)
    {
        $wordArray = explode(" ", $name);
        $reformedStrng = "";
        for ($i = 0; $i < count($wordArray); $i++) {
            $reformedStrng = "$reformedStrng-$wordArray[$i]";
        }

        return "$uuid$reformedStrng";
    }
}
