@extends('layouts.app')

@section('additional_headers')
		<link href="../assets/plugins/notify/css/notifIt.css" rel="stylesheet" />
		<link href="{{asset('assets/plugins/select2/select2.min-dark.css')}}" rel="stylesheet" />
		<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

@endsection

@section('content')

<div class="side-app">
	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Edit Agent Information</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->
  <!--row open-->
				<div class="row">
					<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
						<div class="card">
              <div class="card-header">
								<h3 class="card-title">Edit Agent Profile</h3>
							</div>
								<form action="{{ route('agent.save_edit') }}" method="POST" enctype="multipart/form-data">
									@csrf
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
                          <input type="hidden" name="agent_id" value="{{$agent->id}}">
													<label for="exampleInputEmail1">User Name</label>
													<input type="text" class="form-control" id="user_name" value="{{ $agent->name }}" placeholder="User Name" name="user_name">
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="exampleInputnumber">Conatct Number</label>
													<input type="number" class="form-control" id="mobile" value="{{ $agent->mobile_no }}" placeholder="Mobile Number" name="mobile">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Email address</label>
											<input type="email" class="form-control" id="email" value="{{ $agent->email }}" placeholder="Email Address" name="email">
										</div>
										</div>
										<div class="card-footer text-right">
											<a href="" class="btn btn-danger mt-1">Cancel</a>
											<button type="submit" class="btn btn-success mt-1">Update</button>
										</div>
								</form>
							</div><!-- Card header -->
              <div id="collapseExample" class="card collapse">
                <div class="card-header">
                  <h3 class="card-title">Status Change Assigned Department</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
    								<table id="Agent_Department_Table" class="table table-striped table-bordered text-nowrap w-100">
    									<thead>
    										<tr>
    											<th class="wd-20p">#ID</th>
    											<th class="wd-20p">Name</th>
    											<th class="wd-10p">Status</th>
    											<th class="wd-10p">Created Date</th>
    											<th class="wd-10p">View</th>
    										</tr>
    									</thead>
    									<tbody>
    										@foreach($agentDepartments as $item)
      									<tr>
                            <th>{{ $item->id }}</th>
      											<th>{{ $item->department->name }}</th>
      											<td>{!! App\Agent_department::getStatus($item->is_active) !!}</td>
      											<td>{{ $item->created_at->format('M d, Y') }}</td>
                          <form action="{{ route('agent.active') }}" method="POST">
                            @csrf
                            <input type="hidden" name="agent_id" value="{{$item->id}}">
                            <input type="hidden" name="agent_user" value="{{$item->user_id}}">
      											<td><button type="submit" class="btn btn-sm btn-success">Active</button></td>
                          </form>
    										</tr>
    										@endforeach
    									</tbody>
    								</table>
    							</div>
                </div>
              </div>
						</div>
					<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">My Profile</h3>
								<div class="card-options">
									<a href="{{ route('agent.profile',$agent->id) }}" class="btn btn-primary btn-sm"><i class="si si-eye mr-1"></i>View Profile</a>
								</div>
							</div>
							<div class="card-body">
								<div class="text-center">
									<div class="userprofile ">
										<div class="userpic  brround">
											<img src="../../assets/images/users/female/5.jpg" alt="" class="userpicimg">
										</div>
										<h3 class="username mb-2">Agent</h3>
										<p class="mb-1">{{ $agent->name }} </p>
									</div>
								</div>
							</div>
							<div class="card-footer">
							</div>
						</div>
						<!-- SECOND CARD -->
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Details</h3>
                <div class="card-options">
									<button type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" class="btn btn-primary btn-sm"><i class="si si-pencil mr-1"></i>Active Department</button>
								</div>
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
											<p class="text-muted">{{ $agent->name }}</p>
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
											<p class="text-muted">{{ $agent->email }}</p>
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
											<p class="text-muted">{{ $agent->mobile_no }}</p>
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

@endsection
