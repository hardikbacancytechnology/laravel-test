@extends('adminlte::page')
@if(!isset($user))
@section('title', 'Add new user')
@else
@section('title', 'Edit user')
@endif
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
			<form role="form" method="POST" action="{{ ((!isset($user)) ? route('users.store') : route('users.update',$user->id)) }}" id="create-user-form" autocomplete="off">
				{{ csrf_field() }}
				@if(isset($user))
				{{ method_field('PATCH') }}
				@endif
				<div class="box-body">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{ ((!isset($user)) ? old('name') : $user->name) }}" />
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="{{ ((!isset($user)) ? old('email') : $user->email) }}"/>
					</div>
					@if(!isset($user))
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Enter password" />
					</div>
					@endif
					<h5><b>Give Role</b></h5>
					<div class='form-group'>
				        @foreach ($roles as $role)
				            {{ Form::checkbox('roles[]',$role->id,(isset($user) ? $user->roles : '')) }}
				            {{ Form::label($role->name, ucfirst($role->name)) }}<br>
				        @endforeach
				    </div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-primary submit-form" data-module="create-user">Submit</button>
					<a href="{{ route('users.index') }}" class="btn btn-default ajax_anchor">Cancel</a>
				</div>
			</form>
		</div>
		<!-- /.box -->
	</div>
	<!--/.col (left) -->
</div>
@stop