<?php

namespace App\Helpers;

class Template
{

    public static function showItemHistory($by, $time)
    {
        $output = sprintf('<p><i class="fa fa-user"></i> %s</p><p><i class="fa fa-clock-o"></i> %s</p>', $by, date('d/m/Y H:i', strtotime($time)));
        return $output;
    }

    public static function showItemStatus($controllerName, $id, $status)
    {
        $tempStatus = array(
            'active'    =>  ['name' => 'Kích hoạt', 'class' => 'btn-success'],
            'inactive'  =>  ['name' => 'Chưa kích hoạt', 'class' => 'btn-info'],
        );

        $link_status = route($controllerName . '/status', ['status' => $status, 'id' => $id]);

        $output = sprintf('<a href="%s" type="button" class="btn btn-round %s">%s</a>', $link_status, $tempStatus[$status]['class'], $tempStatus[$status]['name']);
        return $output;
    }

    public static function showItemThumb($controllerName, $thumbName, $thumbAlt)
    {
        $output = sprintf('<img src="%s" alt="%s" class="zvn_thumd" width="500">', asset('images/' . $controllerName . "/" . $thumbName), $thumbAlt);
        return $output;
    }

    public static function showButtonAction($controllerName, $id, $key_remove = null)
    {
        $tempButton = [
            'edit'      => ['class' => 'btn-success',   'title' => 'Edit',      'icon' => 'fa-pencil',  'route-name' => $controllerName . '/form'],
            'delete'    => ['class' => 'btn-danger',    'title' => 'Delete',    'icon' => 'fa-trash',   'route-name' => $controllerName . '/delete'],
            'info'      => ['class' => 'btn-info',      'title' => 'View',      'icon' => 'fa-pencil',  'route-name' => $controllerName . '/form'],
        ];

        if (!empty($key_remove)) {
            if (is_array($key_remove)) {
                foreach ($key_remove as $key) {
                    unset($tempButton[$key]);
                }
            } else {
                if ($key_remove) unset($tempButton[$key_remove]);
            }
        }


        $output = '<div class="zvn-box-btn-filter">';
        foreach ($tempButton as $button) {
            $link = route($button['route-name'], ['id' => $id]);
            $output .= sprintf('<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip" data-placement="top" data-original-title="%s">
                                <i class="fa %s"></i></a>', $link, $button['class'], $button['title'], $button['icon']);
        }
        $output .= '</div>';
        return $output;
    }
}
