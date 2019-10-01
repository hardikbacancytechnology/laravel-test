@extends('adminlte::page')
@section('title', 'Edit Role : '.$role->name)
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
            {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('name', 'Role Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>
                <h5><b>Assign Permissions</b></h5>
                @foreach ($permissions as $permission)
                    {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
                    {{Form::label($permission->name, ucfirst($permission->name)) }}<br>
                @endforeach
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
                <a href="{{ route('roles.index') }}" class="btn btn-default ajax_anchor">Cancel</a>
            </div>
            {{ Form::close() }}    
        </div>
    </div>
</div>
@endsection