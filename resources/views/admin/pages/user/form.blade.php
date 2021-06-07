@extends('admin.main')

@section('content')
    @include('admin.templates.page_header', ['pageIndex' => false])
    @include('admin.templates.error')

    @if (isset($item['id']))
    <div class="row">
        {{--  edit  --}}
        @include('admin.pages.user.form_info')

        {{--  change password  --}}
        @include('admin.pages.user.form_change_password')

        {{--  change level  --}}
        @include('admin.pages.user.form_change_level')
    </div>
        
    @else
        {{--  add new  --}}
        @include('admin.pages.user.form_add')
    @endif
@endsection