@extends('adminlte::page')
@section('title', 'Roles Listing')
@section('content_header')
<h1>@yield('title')</h1>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Roles Listing Data Table</h3>
                <div class="box-tools">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary ajax_anchor" title="Add new role" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
                    <a href="{{ route('users.index') }}" class="btn btn-info ajax_anchor" title="Users" data-toggle="tooltip"><i class="fa fa-users"></i></a>
                    <a href="{{ route('permissions.index') }}" class="btn btn-success ajax_anchor" title="Permissions" data-toggle="tooltip"><i class="fa fa-user-lock"></i></a></h1>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="roles-tbl" class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                                <td>
                                <a href="{{ URL::to('admin/roles/'.$role->id.'/edit') }}" class="btn btn-primary btn-sm ajax_anchor" title="Edit role" data-toggle="tooltip"><i class="fa fa-edit"></i></a> | 
                                <a href="javascript:;" class="btn btn-danger btn-sm confirm-delete" data-module="roles" data-id="{{ $role->id }}" title="Delete role" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
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