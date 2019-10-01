@extends('adminlte::page')
@section('title', 'Permissions Listing')
@section('content_header')
<h1>@yield('title')</h1>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Permissions Listing Data Table</h3>
                <div class="box-tools">
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary ajax_anchor" title="Add new permission" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="permissions-tbl" class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th>Permissions</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td> 
                                <td>
                                    <a href="{{ URL::to('admin/permissions/'.$permission->id.'/edit') }}" class="btn btn-primary btn-sm ajax_anchor" title="Edit permission" data-toggle="tooltip"><i class="fa fa-edit"></i></a> | 
                                    <a href="javascript:;" class="btn btn-danger btn-sm confirm-delete" data-module="permissions" data-id="{{ $permission->id }}" title="Delete permission" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection