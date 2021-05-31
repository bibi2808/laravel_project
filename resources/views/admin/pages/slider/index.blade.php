@php
    use App\Helpers\Template as Template;
    $showButtonFilter = Template::showButtonFilter($controllerName ,$itemsStatusCount, $params['filter']['status']);
    $showAreaSearch = Template::showAreaSearch($controllerName, $params['search']);
@endphp

@extends('admin.main')

@section('content')
    @include('admin.templates.page_header', ['pageIndex' => true])


    @include('admin.templates.notifycation')

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