@extends('adminlte::page')
@section('title', '401 ACCESS DENIED')
@section('content_header')
<h1>@yield('title')</h1>
@stop
@section('content')
<div class="error-page">
	<h2 class="headline text-yellow">401</h2>
	<div class="error-content">
		<h3><i class="fa fa-warning text-yellow"></i> Oops! ACCESS DENIED.</h3>
		<p>You are not authorized to access that module.Meanwhile, you may <a href="{{ route('home') }}" class="ajax_anchor">return to dashboard</a>.</p>
	</div>
	<!-- /.error-content -->
</div>
<!-- /.error-page -->
@endsection