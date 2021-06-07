@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    $formLabelAttr = config('zvn.template.form_label_edit');
    $formInputAtts = config('zvn.template.form_input');

    $inputHiddenID = Form::hidden('id', $item['id'] ?? null);
    $inputHiddenTask = Form::hidden('task', 'change_password');

    $elements = [
        [
            'label'     => Form::label('password', 'Password',$formLabelAttr),
            'element'   => Form::password('password', $formInputAtts)
        ],
        [
            'label'     => Form::label('password_confirmation', 'Password Confirmation',$formLabelAttr),
            'element'   => Form::password('password_confirmation', $formInputAtts)
        ],
        [
            'element'   => $inputHiddenID . $inputHiddenTask . Form::submit('Save', ['class' => 'btn btn-success']),
            'type'      => 'btn-submit-edit'
        ]
    ];
    
@endphp

<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Form Change Password'])
        
        {!! Form::open([
            'method'            => 'POST',
            'url'               =>  route("$controllerName/change-password"),
            'accept-charset'    => "UTF-8",
            'enctype'           => "multipart/form-data",
            'class'             => "form-horizontal form-label-left",
            'id'                => "main-form"]) 
        !!}

        {!! FormTemplate::show($elements) !!}

        {!! Form::close() !!}
        
    </div>
</div>