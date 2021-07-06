@php
    echo 'ok';
@endphp

@extends('news.login')
@section('content')
<div class="card fat">
    <div class="card-body">
        <h4 class="card-title">Register</h4>
            @include('news.pages.template.error')
			@include('news.pages.template.alert')
        {!! Form::open([
            'method' => 'POST',
            'url'       => route("$controllerName/postRegister"),
            'id' =>'auth-form'
            ]) !!}
            <div class="form-group">
				{!! Form::label('username', 'UserName') !!}
				{!! Form::text('username', null, ['class' => 'form-control', 'required' => true, 'autofocus' => true]) !!}
            </div>
            <div class="form-group">
				{!! Form::label('fullname', 'FullName') !!}
				{!! Form::text('fullname', null, ['class' => 'form-control', 'required' => true, 'autofocus' => true]) !!}
            </div>

            <div class="form-group">
				{!! Form::label('email', 'Email') !!}
				{!! Form::text('email', null, ['class' => 'form-control', 'required' => true, 'autofocus' => true]) !!}
            </div>
            
            <div class="form-group">
				{!! Form::label('password', 'Password') !!}
				{!! Form::password('password', ['class' => 'form-control', 'required' => true, 'data-eye' => true]) !!}
            </div>
            <div class="form-group no-margin">
                <button type="submit" class="btn btn-primary btn-block">
                    Register
                </button>
            </div>
            <div class="margin-top20 text-center">
            Already have an account? <a href='{{ route("$controllerName/login") }}'>Login</a>
            </div>
    </div>
</div>
@endsection