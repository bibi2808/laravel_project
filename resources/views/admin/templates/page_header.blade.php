@php
    $pageTitle = 'Manage ' . ucfirst($controllerName);

    $link = route($controllerName);
    $icon = 'fa-arrow-left';
    $title = 'Home';

    if($pageIndex == true){
        $link = route($controllerName . '/form');
        $icon = 'fa-plus-circle';
        $title = ' Add';
    }

    $pageButton = sprintf('<a href="%s" class="btn btn-info"><i class="fa %s"></i> %s</a>', $link, $icon, $title);
@endphp



<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>{{ $pageTitle }}</h3>
    </div>
    <div class="zvn-add-new pull-right">
        {!! $pageButton !!}
    </div>
</div>