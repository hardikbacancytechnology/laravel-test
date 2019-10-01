@extends('adminlte::page')
@section('title', 'Posts Listing')
@section('content_header')
<h1>@yield('title')</h1>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Posts Listing Data Table</h3>
                <div class="box-tools">
                    <a href="{{ route('posts.create') }}" class="btn btn-primary ajax_anchor" title="Add new post" data-toggle="tooltip" data-placement="left"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Posts</h3></div>
                    <div class="panel-heading">Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</div>
                    <div class="panel-body">
                        <ul>
                        @foreach ($posts as $post)
                        <li style="list-style-type:disc">
                            <a href="{{ route('posts.show', $post->id ) }}" class="ajax_anchor"><b>{{ $post->title }}</b><br>
                                <p class="teaser">
                                   {!!  str_limit($post->body, 100) !!} {{-- Limit teaser to 100 characters --}}
                                </p>
                            </a>
                        </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="text-center">
                    {!! $posts->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection