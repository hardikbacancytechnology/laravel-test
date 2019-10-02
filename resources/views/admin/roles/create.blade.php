@extends('adminlte::page')
@section('title', 'Add New Role')
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
            {{ Form::open(array('url' => 'admin/roles','id'=>'create-roles-form')) }}
            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>
                <h5><b>Assign Permissions</b></h5>
                <div class='form-group'>
                    @foreach ($permissions as $permission)
                        {{ Form::checkbox('permissions[]',  $permission->id ) }}
                        {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
                    @endforeach
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {{ Form::submit('Add', array('data-module'=>'create-roles','class' => 'btn btn-primary submit-form')) }}
                <a href="{{ route('roles.index') }}" class="btn btn-default ajax_anchor">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection