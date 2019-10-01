@extends('adminlte::page')
@section('title', 'Users Listing')
@section('content_header')
<h1>Users Listing</h1>
@stop
@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Users Listing Data Table</h3>
				<div class="box-tools">
					<a href="{{ route('users.create') }}" class="btn btn-primary ajax_anchor" title="Add new user" data-toggle="tooltip" data-placement="left"><i class="fa fa-plus"	></i></a>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table id="users-tbl" class="table table-bordered table-hover dt-responsive data-table" style="width:100%">
					<thead>
						<tr>
		                    <th>Sr. No</th>
		                    <th>Id</th>
		                    <th>Name</th>
		                    <th>Email</th>
		                    <th>Date/Time Added</th>
		                    <th>User Roles</th>
		                    <th>Operations</th>
		                </tr>
					</thead>
					<tfoot>
						<tr>
							<th>Sr. No</th>
							<th>Id</th>
							<th>Name</th>
		                    <th>Email</th>
		                    <th>Date/Time Added</th>
		                    <th>User Roles</th>
		                    <th>Operations</th>
						</tr>
					</tfoot>
				</table>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
@stop