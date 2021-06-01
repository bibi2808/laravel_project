<?php

namespace App\Helpers;

class Template
{
    public static function modeHistory($by, $time)
    {
        $xhtml = sprintf(
            '<p><i class="fa fa-user"></i> %s </p>
            <p><i class="fa fa-clock-o"></i> %s </p>',
            $by,
            date(config('zvn.format.long_time'), strtotime($time))
        );
        return $xhtml;
    }

    public static function showItemStatus($controllerName, $id, $statusValue)
    {
        $tmpStatus = config('zvn.template.status');
        $statusValue = array_key_exists($statusValue, $tmpStatus) ? $statusValue : 'default';

        $currentTemplateStatus = $tmpStatus[$statusValue];
        $link = route($controllerName . '/status', ['status' => $statusValue, 'id' => $id]);

        $xhtml = sprintf(
            '<a href="%s" type="button" class="btn btn-round %s">%s</a>',
            $link,
            $currentTemplateStatus['class'],
            $currentTemplateStatus['name']
        );
        return $xhtml;
    }

    public static function showItemIsHome($controllerName, $id, $isHomesValue)
    {
        $tmpIsHome = config('zvn.template.is_home');
        $isHomesValue = array_key_exists($isHomesValue, $tmpIsHome) ? $isHomesValue : 'yes';

        $currentTemplateIsHome = $tmpIsHome[$isHomesValue];
        $link = route($controllerName . '/isHome', ['isHome' => $isHomesValue, 'id' => $id]);
        $xhtml = sprintf(
            '<a href="%s" type="button" class="btn btn-round %s">%s</a>',
            $link,
            $currentTemplateIsHome['class'],
            $currentTemplateIsHome['name']
        );
        return $xhtml;
    }

    public static function showButtonFilter($controllerName, $itemsStatusCount, $currentFilterStatus)
    {
        $tmpStatus = config('zvn.template.status');
        $xhtml = null;

        if (count($itemsStatusCount) > 0) {
            array_unshift(
                $itemsStatusCount,
                [
                    'status' => 'all',
                    'count' => array_sum(array_column($itemsStatusCount, 'count'))
                ]
            );
            foreach ($itemsStatusCount as $item) {
                $statusValue = $item['status']; // item = [count, status]
                $statusValue = array_key_exists($statusValue, $tmpStatus) ? $statusValue : 'default';

                $currentTemplateStatus = $tmpStatus[$statusValue];
                $link = route($controllerName) . '?filter_status=' . $statusValue;
                $class = ($currentFilterStatus == $statusValue) ? 'btn-danger' : 'btn-primary';

                $xhtml .= sprintf('<a href="%s" type="button" class="btn %s">%s 
                                    <span class="badge bg-white"  >%s</span>
                                    </a>', $link, $class, $currentTemplateStatus['name'], $item['count']);
            }
        }
        return $xhtml;
    }

    public static function showAreaSearch($controllerName, $paramsSearch)
    {
        $xhtml = null;
        $tmpField = config('zvn.template.search'); // 'all' => ['name' => 'Search by All'],
        $fieldController = config('zvn.config.search'); // 'slider' => ['all', 'id', 'description'],

        // kiểm tra field search có tồn tại trong route Slider không?
        $searchField = in_array($paramsSearch['field'], $fieldController[$controllerName]) ? $paramsSearch['field'] : 'all';
        $searchValue = $paramsSearch['value'];
        
        $controllerName = (array_key_exists($controllerName, $fieldController)) ? $controllerName : 'default';

        $xhtmlField = null;
        foreach($fieldController[$controllerName] as $field){
            $xhtmlField .= sprintf('<li><a href="#" class="select-field" data-field="%s">%s</a></li>', $field, $tmpField[$field]['name']);
        }   
      
        $xhtml = sprintf('<div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle btn-active-field" data-toggle="dropdown" aria-expanded="false">%s<span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu"> 
                                    %s 
                                </ul>
                            </div>
                            <input type="text" name="search_value" value="%s" class="form-control">
                            <input type="hidden" name="search_field" value="%s">
                            <span class="input-group-btn">
                                <button id="btn-clear-search" type="button" class="btn btn-success" style="margin-right: 0px">Clear</button>
                                <button id="btn-search" type="button" class="btn btn-primary">Search</button>
                            </span>
                        </div>',$tmpField[$searchField]['name'], $xhtmlField, $searchValue, $searchField);

        return $xhtml;
    }

    public static function showItemThumb($controllerName, $thumbName, $thumbAlt)
    {
        $xhtml = sprintf(
            '<img src="%s" alt="%s" class="zvn-thumb">',
            asset("admin/img/$controllerName/$thumbName"),
            $thumbAlt
        );
        return $xhtml;
    }

    public static function showButtonAction($controllerName, $id)
    {
        // define type of button
        $tmlButton = config('zvn.template.button');

        // define button of page
        $buttonArea = config('zvn.config.button');

        $controllerName = (array_key_exists($controllerName, $buttonArea)) ? $controllerName : 'default';
        $listButtons = $buttonArea[$controllerName];

        $xhtml = '<div class="zvn-box-btn-filter">';

        foreach ($listButtons as $btn) {
            $currentButton = $tmlButton[$btn];
            $link = route($controllerName . $currentButton['route-name'], ['id' => $id]);
            $xhtml .= sprintf(
                '<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip" data-placement="top" data-original-title="%s">
                <i class="fa %s"></i>
                </a>',
                $link,
                $currentButton['class'],
                $currentButton['title'],
                $currentButton['icon']
            );
        }

        $xhtml .= '</div>';
        return $xhtml;
    }
}