<?php

namespace App\Helpers;

use Config;

class Template
{

    public static function showItemHistory($by, $time)
    {
        $output = sprintf('<p><i class="fa fa-user"></i> %s</p><p><i class="fa fa-clock-o"></i> %s</p>', $by, date('d/m/Y H:i', strtotime($time)));
        return $output;
    }

    public static function showItemStatus($controllerName, $id, $status)
    {
        $tempStatus = Config::get('pvt.template.status');

        $link_status = route($controllerName . '/status', ['status' => $status, 'id' => $id]);

        $statusCurrent = (array_key_exists($status, $tempStatus)) ? $status : 'default';
        $currTemp = $tempStatus[$statusCurrent];

        $output = sprintf('<a href="%s" type="button" class="btn btn-round %s">%s</a>', $link_status, $currTemp['class'], $currTemp['name']);
        return $output;
    }

    public static function showItemThumb($controllerName, $thumbName, $thumbAlt)
    {
        $output = sprintf('<img src="%s" alt="%s" class="zvn_thumd" width="500">', asset('images/' . $controllerName . "/" . $thumbName), $thumbAlt);
        return $output;
    }

    public static function showButtonAction($controllerName, $id, $key_remove = null)
    {
        $tempButton = Config::get('pvt.template.button');

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
            $link = route($controllerName . $button['route-name'], ['id' => $id]);
            $output .= sprintf('<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip" data-placement="top" data-original-title="%s">
                                <i class="fa %s"></i></a>', $link, $button['class'], $button['title'], $button['icon']);
        }
        $output .= '</div>';
        return $output;
    }

    public static function showButtonStatus($controllerName, $itemsStatusCount = 0, $currentActive)
    {
        $xhtml = null;
        $tempStatus =  Config::get('pvt.template.status');

        if ($itemsStatusCount > 0) {
            array_unshift($itemsStatusCount, [
                'count' => array_sum(array_column($itemsStatusCount, 'count')),
                'status' => 'all'
            ]);

            foreach ($itemsStatusCount as $key => $item) {
                $statusCurrent = $item['status'];
                $statusCurrent =  (array_key_exists($item['status'], $tempStatus)) ? $statusCurrent : 'default';

                $currTemp = $tempStatus[$statusCurrent];

                $link_status = route($controllerName) . '?filter_status=' . $statusCurrent;
                $class = ($statusCurrent == $currentActive) ? 'btn-danger' : 'btn-primary';

                $xhtml .= sprintf('<a href="%s" type="button" class="btn %s"> %s <span class="badge bg-white">%s</span> </a>', $link_status, $class, $currTemp['name'],  $item['count']);
            }
        }
        return $xhtml;
    }


    public static function showAreaSearch($controllerName, $paramSearch = null)
    {
        $xhtml = null;
        $tempField =  Config::get('pvt.template.search');
        $fieldInController = Config::get('pvt.config.search');

        $keyword = (isset($paramSearch['value'])) ? $paramSearch['value'] : '';

        $controllerName = (array_key_exists($controllerName, $fieldInController)) ? $controllerName : 'default';
        $searchBy = null;
        foreach ($fieldInController[$controllerName] as $key) {
            $searchBy .= sprintf('<li><a href="#" class="select-field" data-field="%s">%s</a></li>', $key, $tempField[$key]['name']);
        }

        $searchField = (in_array($paramSearch['field'], $fieldInController[$controllerName])) ? $tempField[$paramSearch['field']]['name'] : 'all';

        $xhtml = sprintf('<div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle btn-active-field" data-toggle="dropdown" aria-expanded="false">
                                    %s <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">%s</ul>
                            </div>
                            <input type="text" class="form-control" name="search_value" value="%s">
                            <input type="hidden" name="search_field" value="all">
                            <span class="input-group-btn">
                                <button id="btn-clear" type="button" class="btn btn-success" style="margin-right: 0px">Xóa tìm kiếm</button>
                                <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
                            </span>
                        </div>', 
                        $searchField, $searchBy, $keyword);
        return $xhtml;
    }
}
