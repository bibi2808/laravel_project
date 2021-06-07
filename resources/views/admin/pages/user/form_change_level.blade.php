@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    $formLabelAttr = config('zvn.template.form_label_edit');
    $formInputAtts = config('zvn.template.form_input');

    $selectLevel = ['default' => 'Select level', 'admin' => config('zvn.template.level.admin.name'), 'member' => config('zvn.template.level.member.name')];

    $inputHiddenID = Form::hidden('id', $item['id'] ?? null);
    $inputHiddenTask = Form::hidden('task', 'change_level');

    $elements = [
        [
            'label'     => Form::label('level', 'Level',$formLabelAttr ),
            'element'   => Form::select('level', $selectLevel, $item['level'] ?? null,  $formInputAtts)
        ],
        [
            'element'   => $inputHiddenID . $inputHiddenTask . Form::submit('Save', ['class' => 'btn btn-success']),
            'type'      => 'btn-submit-edit'
        ] 
    ];
    
@endphp


<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Form Change Level'])
        
        {!! Form::open([
            'method'            => 'POST',
            'url'               =>  route("$controllerName/change-level"),
            'accept-charset'    => "UTF-8",
            'enctype'           => "multipart/form-data",
            'class'             => "form-horizontal form-label-left",
            'id'                => "main-form"]) 
        !!}

        {!! FormTemplate::show($elements) !!}

        {!! Form::close() !!}
    </div>
</div>