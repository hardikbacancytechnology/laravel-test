@extends('adminlte::page')
@section('title', 'Change Password')
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
			<form role="form" action="{{ url('admin/users/change-password') }}" id="change-password-form" autocomplete="off">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="form-group">
						<label for="old_pwd">Old Password</label>
						<input type="password" class="form-control" name="old_pwd" id="old_pwd" placeholder="Enter password" />
					</div>
					<div class="form-group">
						<label for="new_pwd">New Password</label>
						<input type="password" class="form-control" name="new_pwd" id="new_pwd" placeholder="New password" />
					</div>
					<div class="form-group">
						<label for="confirm_pwd">Confirm Password</label>
						<input type="password" class="form-control" name="confirm_pwd" id="confirm_pwd" placeholder="Confirm password" />
					</div>
				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<button type="submit" class="btn btn-primary submit-form" data-module="change-password">Submit</button>
				</div>
			</form>
		</div>
		<!-- /.box -->
	</div>
	<!--/.col (left) -->
</div>
@stop