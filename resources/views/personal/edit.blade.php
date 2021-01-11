@extends('layouts.app')

@section('additional_headers')
		<link href="../assets/plugins/notify/css/notifIt.css" rel="stylesheet" />
		<link href="{{asset('assets/plugins/select2/select2.min-dark.css')}}" rel="stylesheet" />
		<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
		<link href="{{asset('assets/plugins/fileuploads/css/dropify.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')

<div class="side-app">
	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="{{route('deshboard.home')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Edit Personal Information</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->
  <!--row open-->
				<div class="row">
					<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
						<div class="card"> <div class="card-header">
								<h3 class="card-title">Edit Profile</h3>
							</div>
              @php
                 if(Auth::user()->canDepartmentAdmin()){
                   $dep = App\Department::where('user_id',$user->id)->first();
                 }
              @endphp
								<form action="{{ route('deshboard.save_edit') }}" method="POST" enctype="multipart/form-data">
									@csrf
									<div class="card-body">
                    @if(Auth::user()->canDepartmentAdmin())
  										<div class="form-group">
  											<label for="exampleInputname">Department Name</label>
  											<input type="hidden" name= "department_id" value="{{$dep->id}}">
  											<input type="text" class="form-control" id="department_name" value="{{$dep->name}}" placeholder="Department Name" name="department_name">
  										</div>
                    @endif
										<div class="row">
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="exampleInputEmail1">Name</label>
                          <input type="hidden" name= "user_id" value="{{$user->id}}">
													<input type="text" class="form-control" id="user_name" value="{{ $user->name }}" placeholder="User Name" name="user_name">
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="exampleInputnumber">Conatct Number</label>
													<input type="number" class="form-control" id="mobile" value="{{ $user->mobile_no }}" placeholder="Mobile Number" name="mobile">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Email address</label>
											<input type="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="Email Address" name="email">
										</div>
                    @if(Auth::user()->canDepartmentAdmin())
  										<div class="form-group">
  											<label for="exampleInputname1">Address</label>
  											<input type="text" class="form-control" id="address" value="{{ $dep->address }}" placeholder="Address" name="address">
  										</div>
                    @endif

										<div class="form-group">
											<label for="exampleInputImage">Email address</label>
											<input type="file" class="dropify" id="address" name="image" data-default-file="">
										</div>

										</div>
										<div class="card-footer text-right">
											<a href="" class="btn btn-danger mt-1">Cancel</a>
											<button type="submit" class="btn btn-success mt-1">Update</button>
										</div>
								</form>
							</div>
						</div>
					<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">My Profile</h3>
								<div class="card-options">
									<a href="{{ route('deshboard.profile') }}" class="btn btn-primary btn-sm"><i class="si si-eye mr-1"></i>View Profile</a>
								</div>
							</div>
							<div class="card-body">
								<div class="text-center">
									<div class="userprofile ">
										<div class="userpic  brround">
											@if($user->access_level == 'master_admin')
												<img src="{{asset('assets/images/users/female/admin_person.jpg')}}" alt="" style="height:100%; width:100%;" class="userpicimg">
											@elseif($user->access_level == 'department_admin')
												<img src="{{asset('assets/images/users/female/department_admin.jpg')}}" alt="" style="height:100%; width:100%;" class="userpicimg">
											@elseif($user->access_level == 'agent')
												<img src="{{asset('assets/images/users/female/agent.jpg')}}" alt="" style="height:100%; width:100%;" class="userpicimg">
											@endif
										</div>
                    @if($user->access_level == 'master_admin')
                    	<h3 class="username mb-2">Admin</h3>
            				@elseif($user->access_level == 'department_admin')
            					<h3 class="username mb-2">Department</h3>
            				@elseif($user->access_level == 'agent')
            					<h3 class="username mb-2">Agent</h3>
            				@endif
                    @if(Auth::user()->canDepartmentAdmin())
										  <p class="mb-1">{{ $dep->name }}</p>
                    @endif
									</div>
								</div>
							</div>
						</div>
						<!-- SECOND CARD -->
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Details</h3>
							</div>
							<div class="card-body">
								<div class="container">
									<div class="row">
										<div class="col-md-4 col-sm-6">
											<p class="text-center text-primary h6">
												<i class="fa fa-id-card"></i> Name:
											</p>
										</div>
										<div class="col-md-8 col-sm-6 h6">
											<p class="text-muted">{{ $user->name }}</p>
										</div>
									</div>
									<hr class="mt-1">
									<div class="row">
										<div class="col-md-4 col-sm-6">
											<p class="text-center text-primary h6">
												<i class="fa fa-envelope"></i> Email:
											</p>
										</div>
										<div class="col-md-8 col-sm-6 h6">
											<p class="text-muted">{{ $user->email }}</p>
										</div>
									</div>
									<hr class="mt-1">
                  @if(Auth::user()->canDepartmentAdmin())
  									<div class="row">
  										<div class="col-md-4 col-sm-6">
  											<p class="text-center text-primary h6">
  												<i class="fa fa-map-marker"></i> Address:
  											</p>
  										</div>
  										<div class="col-md-8 col-sm-6 h6">
  											<p class="text-muted">{{ $dep->address }}</p>
  										</div>
  									</div>
									  <hr class="mt-1">
                  @endif
									<div class="row">
										<div class="col-md-4 col-sm-6">
											<p class="text-center text-primary h6">
												<i class="fa fa-mobile"></i> Mobile:
											</p>
										</div>
										<div class="col-md-8 col-sm-6 h6">
											<p class="text-muted">{{ $user->mobile_no }}</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
	<!--row closed-->
</div>
<!--End side app-->
@endsection

@section('additional_scripts')
<!--Accordion-Wizard-Form js-->
<!-- <script src="../assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script> -->
<script src="{{ asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>
<script src="../assets/plugins/notify/js/notifIt.js"></script>
<script src="../assets/plugins/select2/select2.full.min.js"></script>
<script src="{{ asset('assets/plugins/fileuploads/js/dropify.js') }}"></script>
<script src="{{ asset('assets/plugins/fileuploads/js/dropify-demo.js') }}"></script>

@endsection
