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
				<h3 class="box-title">Hover Data Table</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table id="users-tbl" class="table table-bordered table-hover dt-responsive" style="width:100%">
					<thead>
						<tr>
							<th>Sr No.</th>
							<th>Id</th>
							<th>Name</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Sr No.</th>
							<th>Id</th>
							<th>Name</th>
							<th>Email</th>
							<th>Action</th>
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