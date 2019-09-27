@extends('adminlte::page')
@section('title', 'Add new user')
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
			<form role="form" method="POST" action="{{ route('users.store') }}" id="create-user-form" autocomplete="off">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Enter name" />
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="Enter email" />
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Enter password" />
					</div>
				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<button type="submit" class="btn btn-primary submit-form" data-module="create-user">Submit</button>
				</div>
			</form>
		</div>
		<!-- /.box -->
	</div>
	<!--/.col (left) -->
</div>
@stop