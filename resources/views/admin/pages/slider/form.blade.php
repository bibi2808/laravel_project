@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    $formLabelAttr = config('zvn.template.form_label');
    $formInputAtts = config('zvn.template.form_input');

    $selectStatus = ['default' => 'Select status', 'active' => config('zvn.template.status.active.name'), 'inactive' => config('zvn.template.status.inactive.name')];

    $inputHiddenID = Form::hidden('id', $item['id'] ?? null);
    $inputHiddenThumb = Form::hidden('thumb_current', $item['thumb'] ?? null);

    $elements = [
        [
            'label'     => Form::label('name', 'Name',$formLabelAttr),
            'element'   => Form::text('name', $item['name'] ?? null, $formInputAtts)
        ],
        [
            'label'     => Form::label('description', 'Description',$formLabelAttr ),
            'element'   => Form::text('description', $item['description'] ?? null, $formInputAtts)
        ],
        [
            'label'     => Form::label('status', 'Status',$formLabelAttr ),
            'element'   => Form::select('status', $selectStatus, $item['status'] ?? null,  $formInputAtts)
        ],
        [
            'label'     => Form::label('link', 'Link',$formLabelAttr ),
            'element'   => Form::text('link', $item['link'] ?? null, $formInputAtts)
        ],
        [
            'label'     => Form::label('thumb', 'Thumb',$formLabelAttr ),
            'element'   => Form::file('thumb', $formInputAtts),
            'thumb'     => (!empty($item['id'])) ? Template::showItemThumb($controllerName, $item['thumb'], $item['name']) : null,
            'type'      => 'thumb'
        ],
        [
            'element'   => $inputHiddenID . $inputHiddenThumb . Form::submit('Save', ['class' => 'btn btn-success']),
            'type'      => 'btn-submit'
        ]
        
    ];
    
@endphp

@extends('admin.main')

@section('content')
    @include('admin.templates.page_header', ['pageIndex' => false])

    @include('admin.templates.error')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Form'])
                
                {!! Form::open([
                    'method'            => 'POST',
                    'action'            =>  [ucfirst($controllerName) . "Controller@save"],// Noted !!!
                    'accept-charset'    => "UTF-8",
                    'enctype'           => "multipart/form-data",
                    'class'             => "form-horizontal form-label-left",
                    'id'                => "main-form"]) 
                !!}

                {!! FormTemplate::show($elements) !!}

                {!! Form::close() !!}
                
            </div>
        </div>
    </div>
@endsection