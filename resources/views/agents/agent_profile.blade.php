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
			<li class="breadcrumb-item active" aria-current="page">Agent Profile</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->
  <!--row open-->
<div class="row">
  <div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class=" card-profile">
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<h2 class="text-primary">Agent Profile</h2><h5 class="text-primary"><sup><i class="fa fa-info-circle"></i></sup></h5>
							</div>
						</div>
						<div class="col-md-6">
							<a href="{{ route('agent.edit',$agent->id) }}" class="btn btn-pill btn-info btn-sm float-right">
									<i class="fa fa-pencil"></i> Edit profile
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="row mt-5">
									<img class="avatar avatar-xxl brround mr-2 mx-auto d-block" src="../../assets/images/users/female/14.jpg" alt="img">
							</div>
							<div class="row mt-5">
								<a href="" class="btn btn-pill btn-success btn-sm mx-auto d-block" data-toggle="modal" id="btnDepartment" data-target="#departmentModal">
										<i class="pe pe-7s-users"></i> Department
								</a>
							</div>
						</div>
						<div class="col-md-5">
							<h5>
									<strong class="text-primary">Name :</strong> {{ $agent->name }}
							</h5>
							<hr class="my-2">
							<h5>
								<strong class="text-primary">Email :</strong> {{ $agent->email }}
							</h5>
							<hr class="my-2">
							<h5>
								<strong class="text-primary">Mobile no. :</strong> {{ $agent->mobile_no }}
							</h5>
							<hr class="my-2">
						</div>
						<div class="col-md-4">
							<hr class="my-2">
							<h6 class="text-center">
								<i class="si si-exclamation text-primary"></i> {{ count($openTickets) }} <span class="text-secondary">Open Ticket</span>
							</h6>
							<hr class="my-2">
							<h6 class="text-center">
								<i class="si si-close text-primary"></i> {{ count($closeTickets) }} <span class="text-secondary">Close Ticket</span>
							</h6>
							<hr class="my-2">
							<h6 class="text-center">
								<i class="pe pe-7s-users text-primary"></i> {{ count($agentDepartments) }} <span class="text-secondary">Department</span>
							</h6>
							<hr class="my-2">
						</div>
					</div><!--- row ends----->
				</div>
			</div>
		</div>
	</div>
</div>
<!---              Departments Recent Tickets         ------->
@if(count($tickets) > 0)
<div class="row">
	<div class="card">
		<div class="card-header">
				<h3 class="card-title">Departments Recent Tickets</h3>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="Open_ticket_table" class="table table-striped table-bordered text-nowrap w-100">
					<thead>
						<tr>
							<th class="wd-20p">#ID</th>
							<th class="wd-20p">Ticket Title</th>
							<th class="wd-15p">Category</th>
							<th class="wd-10p">Priority</th>
							<th class="wd-10p">Created Date</th>
							<th class="wd-10p">View</th>
						</tr>
					</thead>
					<tbody>
						@foreach($tickets as $item)
						<tr>
							<th>{{ $item->id }}</th>
							<th>{{ $item->title }}</th>
							<th>{{ $item->ticketCategory->category ?? "Other" }}</th>
							<th>{!! App\Ticket::getTicketPriorityString($item->priority) !!}</th>
							<td>{{ $item->created_at->format('M d, Y') }}</td>
							<td><a href="{{ route('ticket.display',$item->id) }}" class="btn btn-sm btn-primary">view</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div><!--- card ends---->
</div><!--- row ends----->
@endif

<!---              Recent Open Tickets        ------->
@if(count($openTickets) > 0)
<div class="row">
	<div class="card">
		<div class="card-header">
				<h3 class="card-title">Recent Open Tickets</h3>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="Open_ticket_table" class="table table-striped table-bordered text-nowrap w-100">
					<thead>
						<tr>
							<th class="wd-20p">#ID</th>
							<th class="wd-20p">Ticket Title</th>
							<th class="wd-15p">Category</th>
							<th class="wd-10p">Priority</th>
							<th class="wd-10p">Created Date</th>
							<th class="wd-10p">View</th>
						</tr>
					</thead>
					<tbody>
						@foreach($openTickets as $item)
						<tr>
							<th>{{ $item->id }}</th>
							<th>{{ $item->title }}</th>
							<th>{{ $item->ticketCategory->category ?? "Other" }}</th>
							<th>{!! App\Ticket::getTicketPriorityString($item->priority) !!}</th>
							<td>{{ $item->created_at->format('M d, Y') }}</td>
							<td><a href="{{ route('ticket.display',$item->id) }}" class="btn btn-sm btn-primary">view</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div><!--- card ends---->
</div><!--- row ends----->
@endif

<!---              Recent Close Tickets        ------->
@if(count($closeTickets) > 0)
<div class="row">
	<div class="card">
		<div class="card-header">
				<h3 class="card-title">Recent Close Tickets</h3>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="Open_ticket_table" class="table table-striped table-bordered text-nowrap w-100">
					<thead>
						<tr>
							<th class="wd-20p">#ID</th>
							<th class="wd-20p">Ticket Title</th>
							<th class="wd-15p">Category</th>
							<th class="wd-10p">Priority</th>
							<th class="wd-10p">Created Date</th>
							<th class="wd-10p">View</th>
						</tr>
					</thead>
					<tbody>
						@foreach($closeTickets as $item)
						<tr>
							<th>{{ $item->id }}</th>
							<th>{{ $item->title }}</th>
							<th>{{ $item->ticketCategory->category ?? "Other" }}</th>
							<th>{!! App\Ticket::getTicketPriorityString($item->priority) !!}</th>
							<td>{{ $item->created_at->format('M d, Y') }}</td>
							<td><a href="{{ route('ticket.display',$item->id) }}" class="btn btn-sm btn-primary">view</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div><!--- card ends---->
</div><!--- row ends----->
@endif
<!--End side app-->

<!---Model Start--->
<div class="modal fade" id="departmentModal" aria-labelledby="departmentModal" aria-hidden="true" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="example-Modal3">Department Under {{ $agent->name }}</h5>
				<div class="card-options show">
					<a href="" class="mr-4 text-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
						<span class="fa fa-ellipsis-v"></span>
					</a>
					<ul class="dropdown-menu dropdown-menu-right show" role="menu" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(944px, -120px, 0px);">
						<li><a href="#" id="addDepartment"><i class="si si-plus mr-2"></i>Add</a></li>
						<li><a href="#" data-dismiss="modal" aria-label="Close"><i class="si si-close mr-2"></i>Close</a></li>
					</ul>
				</div>
			</div>
			<div class="modal-body">
					<div id="department-fade" class="container">
						<form action="{{ route('agent.assign_department') }}" method="POST" enctype="multipart/form-data">
							@csrf
		          <div class="form-group">
		            <label class="form-label">Add Department:</label>
		            <div class="row">
		              <div class="col-md-10">
										<input type="hidden" name= "agent_id" value="{{$agent->id}}">
		                <select class="select2" data-placeholder="Choose Departments" name="departments[]" multiple style="width:100% !important">
		                  @foreach($departments as $department)
		                    <option value="{{$department->id}}">{{$department->name}}</option>
		                  @endforeach
		                </select>
		              </div>
		              <div class="col-md-2 mt-2">
										<button type="submit" class="btn btn-pill btn-sm btn-secondary"><i class="fa fa-check-circle-o"></i></button>
  								</form>
										<a id="hideDepartment" class="btn btn-pill btn-sm btn-danger"><i class="fa fa-minus-circle"></i></a>
		              </div>
		            </div>
		          </div>

					</div>
					<div class="card">
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
										<form action="{{ route('agent.inactive') }}" method="POST" enctype="multipart/form-data">
											@csrf
											<th>{{ $item->id }}</th>
											<th>{{ $item->department->name }}</th>
											<td>{!! App\Agent_department::getStatus($item->is_active) !!}</td>
											<td>{{ $item->created_at->format('M d, Y') }}</td>
												<input type="hidden" name= "agent_id" value="{{$item->id}}">
												<input type="hidden" name="agent_user" value="{{$item->user_id}}">
												<td><button type="submit" class="btn btn-sm btn-danger">Inactive</button></td>
										</form>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!---Model End--->

@endsection

@section('additional_scripts')
<script>
$(document).ready(function(){
  $("#department-fade").hide();
  $("#addDepartment").click(function(){
    $("#department-fade").show();
  });
	$("#hideDepartment").click(function(){
    $("#department-fade").hide();
  });
});
</script>

<!--Accordion-Wizard-Form js-->
<!-- <script src="../assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script> -->
<script src="{{ asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>
<script src="{{ asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

<script>
$('.select2').select2({
minimumResultsForSearch: Infinity
});
</script>
@endsection
