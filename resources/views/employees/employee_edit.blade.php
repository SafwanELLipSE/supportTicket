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
			<li class="breadcrumb-item active" aria-current="page">Edit Employee Information</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->
  <!--row open-->
				<div class="row">
					<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Edit Employee Profile</h3>
							</div>
								<form action="{{route('employee.save_edit')}}" method="POST" enctype="multipart/form-data">
									@csrf
									<div class="card-body">
										<div class="form-group">
											<input type="hidden" name="employee_id" value="{{$employee->id}}">
											<label for="exampleInputname">Department Name</label>
											<select class="form-control" id="department" name="department" required>
	 	 										@foreach($departments as $department )
	 	 										<option value="{{$department->id}}">{{$department->name}}</option>
	 	 										@endforeach
 	 	                	</select>
										</div>
										<div class="row">
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="exampleInputEmail1">User Name</label>
													<input type="text" class="form-control" id="exampleInputEmail1" value="{{$employee->name}}" placeholder="Employee Name" name="employee_name">
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="exampleInputnumber">Conatct Number</label>
													<input type="number" class="form-control" id="exampleInputnumber" value="{{$employee->mobile_no}}" placeholder="Mobile Number" name="mobile">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Email address</label>
											<input type="email" class="form-control" id="exampleInputEmail1" value="{{$employee->email}}" placeholder="Email Address" name="email">
										</div>
										<div class="form-group">
											<label for="exampleInputImage">Upload Image</label>
											<input type="file" class="dropify" id="image" name="image" data-default-file="/employee_image/{{$employee->image}}">
										</div>
										</div>
										<div class="card-footer text-right">
											<a href="#" class="btn btn-danger mt-1">Cancel</a>
											<button type="submit" class="btn btn-success mt-1">Save</button>
										</div>
								</form>
							</div>
						</div>
					<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">My Profile</h3>
								<div class="card-options">
									<a href="{{ route('employee.details',$employee->id) }}" class="btn btn-primary btn-sm"><i class="si si-eye mr-1"></i>View Profile</a>
								</div>
							</div>
							<div class="card-body">
								<div class="text-center">
									<div class="userprofile ">
										<div class="userpic  brround">
											<img src="/employee_image/{{$employee->image}}" alt="" style="height:100%; width:100%;" class="rounded-circle">
										</div>
										<h3 class="username mb-2">Employee</h3>
										<p class="mb-1">{{ $employee->department->name }}</p>
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
											<p class="text-muted">{{ $employee->name }} </p>
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
											<p class="text-muted">{{ $employee->email }} </p>
										</div>
									</div>
									<hr class="mt-1">
									<div class="row">
										<div class="col-md-4 col-sm-6">
											<p class="text-center text-primary h6">
												<i class="fa fa-mobile"></i> Mobile:
											</p>
										</div>
										<div class="col-md-8 col-sm-6 h6">
											<p class="text-muted">{{ $employee->mobile_no }}</p>
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
