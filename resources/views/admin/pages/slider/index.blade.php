@php
    use App\Helpers\Template as Template;
    $showButtonFilter = Template::showButtonFilter($controllerName ,$itemsStatusCount, $params['filter']['status']);
    $showAreaSearch = Template::showAreaSearch($controllerName, $params['search']);
@endphp

@extends('admin.main')

@section('content')
<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>Users</h3>
    </div>
    <div class="zvn-add-new pull-right">
        <a href="/form" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Filter'])
            <div class="x_content">
                <div class="row">
                    <div class="col-md-5">
                        {!! $showButtonFilter !!}
                    </div>
                    <div class="col-md-7">
                        {!! $showAreaSearch !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--box-lists-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'List'])
            @include('admin.pages.slider.list')
        </div>
    </div>
</div>
<!--end-box-lists-->

@if (count($items) > 0)
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Pagination'])
                @include('admin.templates.pagination', ['title' => 'Pagination'])
            </div>
        </div>
    </div>
@endif
@endsection