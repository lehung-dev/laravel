<?php

namespace App\Helpers;

class Highlight
{

    public static function show($string, $paramsSearch, $field)
    {

        if ($paramsSearch['value'] == '') return $string;
        if ($paramsSearch['field'] == 'all' || $paramsSearch['field'] == $field) {
            return preg_replace("/" . preg_quote($paramsSearch['value'], '/') . "/i", '<span class="highlight">$0</span>', $string);
        }
        return $string;
    }
}
