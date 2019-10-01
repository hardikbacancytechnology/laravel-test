@extends('adminlte::page')
@section('title', 'Edit Permission : '.$permission->name)
@section('content_header')
<h1>@yield('title')</h1>
@stop
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with permission data --}}
            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('name', 'Permission Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
                <a href="{{ route('permissions.index') }}" class="btn btn-default ajax_anchor">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection