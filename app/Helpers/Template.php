<?php

namespace App\Helpers;

use Config;


class Template
{
    public static function modeHistory($by, $time)
    {
        $xhtml = sprintf(
            '<p><i class="fa fa-user"></i> %s </p>
                        <p><i class="fa fa-clock-o"></i> %s </p>',
            $by,
            date(Config::get('zvn.format.long_time'), strtotime($time))
        );
        return $xhtml;
    }

    public static function showItemStatus($controllerName, $id, $status)
    {
        $tmpStatus = Config::get('zvn.template.status');

        $link = route($controllerName . '/status', ['status' => $status, 'id' => $id]);
        $currentStatus = $tmpStatus[$status];

        $xhtml = sprintf('<a href="%s" type="button" class="btn btn-round %s">%s</a>', $link, $currentStatus['class'], $currentStatus['name']);

        return $xhtml;
    }

    public static function showButtonFilter($countByStatus)
    {
        $tmpStatus = Config::get('zvn.template.status');
        $xhtml = null;
        if(count($countByStatus) > 0) {
            array_unshift($countByStatus, 
                [
                    'status' => 'ALL', 
                    'count' => array_sum(array_column($countByStatus, 'count'))
                ]
            );
            foreach($countByStatus as $value){
                $currentStatus = $tmpStatus[$value['status']];
                $xhtml .= sprintf('<a href="" type="button" class="btn btn-primary">%s 
                                <span class="badge bg-white"  >%s</span>
                             </a>', $currentStatus['name'], $value['count']); 
            }

            
        }

        return $xhtml;
    }

    public static function showItemThumb($controllerName,$thumbName, $thumbAlt){
        $xhtml = sprintf(
            '<img src="%s" alt="%s" class="zvn-thumb">', asset("admin/img/$controllerName/$thumbName") , $thumbAlt );
        return $xhtml;
    }

    public static function showButtonAction($controllerName, $id) {
        // define type of button
        $tmlButton = [
            'edit'      => ['class' => 'btn-success',  'title'  => 'Edit',      'icon' => 'fa-pencil',   'route-name' => $controllerName . '/form'],
            'delete'    => ['class' => 'btn-danger',   'title'  => 'Delete',    'icon' => 'fa-trash',    'route-name' => $controllerName . '/delete'],
            'info'      => ['class' => 'btn-info',     'title'  => 'Info',      'icon' => 'fa-pencil',   'route-name' => $controllerName . '/delete'],
        ];

        // define button of page
        $buttonArea = [
            'default'   => ['edit', 'delete'],
            'slider'    => ['edit', 'delete']
        ];

        $controllerName = (array_key_exists($controllerName, $buttonArea)) ? $controllerName : 'default';
        $listButtons = $buttonArea[$controllerName];

        $xhtml = '<div class="zvn-box-btn-filter">';

        foreach($listButtons as $btn){
            $currentButton = $tmlButton[$btn];
            $link = route($currentButton['route-name'], ['id' => $id]);
            $xhtml .= sprintf(
                '<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip" data-placement="top" data-original-title="%s">
                <i class="fa %s"></i>
                </a>',$link, $currentButton['class'], $currentButton['title'], $currentButton['icon']);
        }
                
        $xhtml .= '</div>';
        return $xhtml;
    }
}
