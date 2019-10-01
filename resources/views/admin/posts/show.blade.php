@extends('adminlte::page')
@section('title', 'View Post')
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
            <div class="box-body">
                <h1>{{ $post->title }}</h1>
                <hr>
                <p class="lead">{!! $post->body !!} </p>
                <hr>
                {!! Form::open(['method' => 'DELETE', 'route' => ['posts.destroy', $post->id] ]) !!}
                <a href="{{ url()->previous() }}" class="btn btn-primary ajax_anchor">Back</a>
                @can('Edit Post')
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info ajax_anchor" role="button">Edit</a>
                @endcan
                @can('Delete Post')
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                @endcan
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection