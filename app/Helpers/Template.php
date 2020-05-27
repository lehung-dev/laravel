<?php

namespace App\Helpers;

class Template
{

    public static function showItemHistory($by, $time)
    {
        $output = sprintf('<p><i class="fa fa-user"></i> %s</p><p><i class="fa fa-clock-o"></i> %s</p>', $by, date('d/m/Y H:i', strtotime($time)));
        return $output;
    }
}
