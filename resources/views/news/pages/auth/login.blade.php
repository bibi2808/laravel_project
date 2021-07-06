@extends('news.login')

@section('content')
<div class="card-wrapper my-auto">
	<div class="brand">
		<img src="{{ asset('auth/img/logo.jpg') }}">
	</div>
	<div class="card fat">
		<div class="card-body">
			<h4 class="card-title">Login</h4>
			@include('news.pages.template.error')
			@include('news.pages.template.alert')
			{!! Form::open([
				'method' => 'POST',
				'url' => route("$controllerName/postLogin"),
				'id' =>'auth-form'
			]) !!}

			<div class="form-group">
				{!! Form::label('email', 'Email') !!}
				{!! Form::text('email', null, ['class' => 'form-control', 'required' => true, 'autofocus' => true]) !!}
			</div>

			<div class="form-group">
				{!! Form::label('password', 'Password') !!}
				{!! Form::password('password', ['class' => 'form-control', 'required' => true, 'data-eye' => true]) !!}
			</div>

			<div class="form-group no-margin">
				<button type="submit" class="btn btn-primary btn-block">Login</button>
			</div>
			<div class="margin-top20 text-center">
			Don't have an account? <a href='{{ route("$controllerName/register") }}'>Create One</a>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection