@extends('adminlte::page')
@section('title', 'Edit Post')
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
            {{ Form::model($post, array('route' => array('posts.update', $post->id), 'method' => 'PUT','id'=>'create-post-form')) }}
            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', null, array('class' => 'form-control')) }}<br>
                </div>
                <div class="form-group">
                    {{ Form::label('body', 'Post Body') }}
                    {{ Form::textarea('body', null, array('class' => 'form-control wysiwyg-editor')) }}<br>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {{ Form::submit('Save', array('data-module'=>'create-post','class' => 'btn btn-primary submit-form')) }}
                <a href="{{ route('posts.index') }}" class="btn btn-default ajax_anchor">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection