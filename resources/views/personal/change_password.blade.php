@extends('layouts.app')

@section('additional_headers')
@endsection

@section('content')
<div class="side-app">
	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="{{route('deshboard.home')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Change Password</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->

	<!-- page-content -->
	<div class="page-content">
		<div class="container text-center text-dark">
			<div class="row">
				<div class="col-lg-6 d-block mx-auto">
					<div class="row">
						<div class="col-xl-12 col-md-12 col-md-12">
							<div class="card">
							 <div class="card-body">
								<div class="text-center mb-6">
									<!-- <img src="{{ asset('assets/images/brand/service_chai.png') }}" class="" alt=""> -->
									<!-- <h3>Support Ticket</h3> -->
								</div>
								<h3>Reset Password</h3>
								@if(session('error'))
										<div class="alert alert-danger" role="alert">
												{{ session('error') }}
										</div>
								@endif
								<form method="POST" action="{{ route('deshboard.new_password') }}">
										@csrf

  								<input type="hidden" name="userId" value="{{ $id }}">

									<div class="input-group  mr-auto ml-auto mb-4">
										<span class="input-group-addon "><i class="fa fa-unlock-alt"></i></span>
										<input type="password" id="old-password" name="old_password" class="form-control" placeholder="Old Password">
									</div>
									<div class="input-group mb-4">
										<span class="input-group-addon "><i class="fa fa-unlock-alt"></i></span>
										<input id="password" type="password" class="form-control" name="new_password" placeholder="New Password">
									</div>
									<div class="input-group mb-4">
										<span class="input-group-addon "><i class="fa fa-unlock-alt"></i></span>
										<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
									</div>
									<div class="text-center">
										<button type="submit" class="btn btn-primary btn-block">submit</button>
									</div>
						 		</form>
							</div>
						</div>
					 </div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- page-content end -->

</div>
<!--End side app-->
@endsection

@section('additional_scripts')
@endsection
