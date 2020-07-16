@extends('layouts.app')

@section('additional_headers')
	
@endsection

@section('content')
<div class="side-app">
	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Notification Page</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->

</div>
<!--End side app-->
@endsection

@section('additional_scripts')

@endsection
