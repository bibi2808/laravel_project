@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    $formLabelAttr = config('zvn.template.form_label');
    $formInputAtts = config('zvn.template.form_input');

    $selectStatus = ['default' => 'Select status', 'active' => config('zvn.template.status.active.name'), 'inactive' => config('zvn.template.status.inactive.name')];

    $inputHiddenID = Form::hidden('id', $item['id'] ?? null);
    $inputHiddenAvatar = Form::hidden('avatar_current', $item['avatar'] ?? null);
    $inputHiddenTask = Form::hidden('task', 'edit_info');

    $elements = [
        [
            'label'     => Form::label('username', 'UserName',$formLabelAttr),
            'element'   => Form::text('username', $item['username'] ?? null, $formInputAtts)
        ],
        [
            'label'     => Form::label('email', 'Email',$formLabelAttr ),
            'element'   => Form::text('email', $item['email'] ?? null, $formInputAtts)
        ],
        [
            'label'     => Form::label('fullname', 'FullName',$formLabelAttr),
            'element'   => Form::text('fullname', $item['fullname'] ?? null, $formInputAtts)
        ],
        [
            'label'     => Form::label('status', 'Status',$formLabelAttr ),
            'element'   => Form::select('status', $selectStatus, $item['status'] ?? null,  $formInputAtts)
        ],
        [
            'label'     => Form::label('avatar', 'Avatar',$formLabelAttr ),
            'element'   => Form::file('avatar', $formInputAtts),
            'avatar'    => (!empty($item['id'])) ? Template::showItemThumb($controllerName, $item['avatar'], $item['username']) : null,
            'type'      => 'avatar'
        ],
        [
            'element'   => $inputHiddenID . $inputHiddenAvatar . $inputHiddenTask . Form::submit('Save', ['class' => 'btn btn-success']),
            'type'      => 'btn-submit'
        ]
        
    ];
    
@endphp


<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Form Info'])
        
        {!! Form::open([
            'method'            => 'POST',
            'url'               =>  route("$controllerName/save"),
            'accept-charset'    => "UTF-8",
            'enctype'           => "multipart/form-data",
            'class'             => "form-horizontal form-label-left",
            'id'                => "main-form"]) 
        !!}

        {!! FormTemplate::show($elements) !!}

        {!! Form::close() !!}
    </div>
</div>