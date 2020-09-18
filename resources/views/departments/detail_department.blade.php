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
			<li class="breadcrumb-item"><a href="{{route('deshboard.home')}}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{route('department.all_departments')}}">Department List</a></li>
			<li class="breadcrumb-item active" aria-current="page">Department Details</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->
  <!--row open-->
<div class="row">
	<div class="col-md-12">
		<div class="card card-profile overflow-hidden">
			<div class="card-body">
				<div class=" card-profile">
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-7">
							<div class="row">
								<h2 class="text-primary">Departmental Profile</h2> <h5 class="text-primary"><sup><i class="fa fa-info-circle"></i></sup></h5>
							</div>
							 <div class="row mt-5">
								 <div class="col-12">
									<h5>
										 	<strong class="text-primary">Name :</strong> {{ $department->name }}
									</h5>
									<hr class="my-2">
									<h5>
										<strong class="text-primary">Manager Name:</strong> {{ $department->user->name }}
									</h5>
									<hr class="my-2">
								 </div>
								 <div class="col-lg-12">
									 <h5>
										 <strong class="text-primary">Email :</strong> {{ $department->user->email }}
									 </h5>
									 <hr class="my-2">
								 </div>
								 <div class="col-12">
									 <div class="row">
									 		<div class="col-md-6">
												<h5>
													<strong class="text-primary">Mobile No.:</strong> {{ $department->user->mobile_no }}
												</h5>
												 <hr class="my-2">
									 		</div>
											<div class="col-md-6">
												<h5>
												 <strong class="text-primary">Created :</strong> {{ $department->created_at->format('M d, Y') }}
											 	</h5>
												<hr class="my-2">
									 		</div>
									 </div>
								 </div>
								 <div class="col-12">
									 <h5>
									 		<strong class="text-primary">Location :</strong> {{ $department->address }}
									 </h5>
								 </div>
							 </div>
						</div>
						<div class="col-md-4 justify-content-center">
							<div class="row justify-content-center">
								<div class="col-12">
									<a href="{{ route('department.edit',$department->id) }}" class="btn btn-pill btn-info btn-sm float-right">
										<i class="fa fa-pencil"></i> Edit profile
									</a>
									<a href="{{route('ticket.open_tickets')}}" class="btn btn-pill btn-info btn-sm float-right">
										<i class="fa fa-ticket"></i> Open Ticket ({{ count($openTickets) }})
									</a>
								</div>
								<div class="col-12 mt-4">
									<div class="card">
										<div class="card-body text-center">
											<div class="h1 m-0">
												<i class="mdi mdi-account-multiple-outline text-primary"></i>
												<strong>{{ count($employees) }}</strong>
											</div>
											<div class="text-muted mb-0">
												Employee
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 mt-1">
									<div class="card">
										<div class="card-body text-center">
											<div class="h1 m-0">
												<i class="zmdi zmdi-labels text-primary"></i>
												<strong>{{ count($department->ticketCategories) }}</strong>
											</div>
											<div class="text-muted mb-0">
												Ticket Category
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
				</div>
				<div class="card-body">
					<div class="nav-wrapper p-0">
						<ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
							<li class="nav-item">
								<a class="nav-link mb-sm-3 mb-md-0 mt-md-2 mt-0 mt-lg-0 active show" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="false"><i class="fa fa-tags mr-2"></i>Ticket Category</a>
							</li>
							<li class="nav-item">
								<a class="nav-link mb-sm-3 mb-md-0 mt-md-2 mt-0 mt-lg-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fa fa-user-secret mr-2"></i>Recent Employee</a>
							</li>
							<li class="nav-item">
								<a class="nav-link mb-sm-3 mb-md-0 mt-md-2 mt-0 mt-lg-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fa fa-ticket mr-2 mt-1"></i>Recent Tickets</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body pb-0">
						<div id="myTabContant" class="tab-content">
							<div aria-labelledby="tabs-icons-text-1-tab" class="tab-pane fade active show" id="tabs-icons-text-1" role="tabpanel">
								<div class="row">
									<div class="col-md-12 col-lg-12">
										<div class="card">
											<div class="card-header">
												<h3 class="card-title">Department Ticket Category</h3>
												<div class="card-options">
													<a data-toggle="modal" data-departmentid="{{$department->id}}" data-target="#categoryModal" class="btn btn-sm btn-primary text-white">
														<i class="fa fa-plus"></i> Add a new Category
													</a>
												</div>
											</div>
											<div class="table-responsive">
												<table class="table card-table table-vcenter text-nowrap table-nowrap">
													<thead class="bg-primary text-white">
														<tr>
															<th class="text-white">ID</th>
															<th class="text-white">Name</th>
															<th class="text-white">Status</th>
															<th class="text-white">Created</th>
															<th class="text-white">Action</th>
														</tr>
													</thead>
													<tbody>
													 @foreach($department->ticketCategories as $item)
														<tr>
															<th scope="row">{{ $item->id }}</th>
															<td>{{ $item->category }}</td>
															<td>{!! App\Department::getStatus($item->is_active) !!}</td>
															<td>{{ $item->created_at->format('M d, Y') }}</td>
															<td>
																<div class="media-body valign-middle text-right overflow-visible">
						                      <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						                        Action
						                      </button>
						                      <ul class="dropdown-menu dropdown-menu-right" role="menu">
						           							<li><a href="#">Active</a></li>
						                        <li><a href="#">Inactive</a></li>
						                      </ul>
						                    </div>
															</td>
														</tr>
													@endforeach
													</tbody>
												</table>
											</div> <!-- table-responsive -->
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
							<div class="row profile ng-scope">
								<div class="card">
									<div class="card-header">
											<h3 class="card-title">Departmental Employees</h3>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="ticket_table" class="table table-striped table-bordered text-nowrap w-100">
												<thead>
													<tr>
														<th class="wd-20p">#ID</th>
														<th class="wd-20p">Name</th>
														<th class="wd-15p">Email</th>
														<th class="wd-10p">Mobile No.</th>
														<th class="wd-10p">Status</th>
														<th class="wd-10p">Created Date</th>
														<th class="wd-10p">View</th>
													</tr>
												</thead>
												<tbody>
													@foreach($employees as $item)
													<tr>
														<th>{{ $item->id }}</th>
														<th>{{ $item->name }}</th>
														<th>{{ $item->email }}</th>
														<th>{{ $item->mobile_no }}</th>
														<td>{!! App\Department_employee::getStatus($item->is_active) !!}</td>
														<td>{{ $item->created_at->format('M d, Y') }}</td>
														<td><a href="{{ route('ticket.display',$item->id) }}" class="btn btn-sm btn-primary">view</a></td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							</div>
							<div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
								<div class="row profile ng-scope">
									<div class="card">
										<div class="card-header">
												<h3 class="card-title">Departments Recent Tickets</h3>
										</div>
										<div class="card-body">
						          <div class="table-responsive">
						            <table id="ticket_table" class="table table-striped table-bordered text-nowrap w-100">
						              <thead>
						                <tr>
						                  <th class="wd-20p">#ID</th>
						                  <th class="wd-20p"> Ticket Title</th>
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
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="categoryModal" aria-labelledby="categoryModal" aria-hidden="true" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="example-Modal3">Add New Category</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('department.add_category') }}"method="POST" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<input type="hidden" name="department_id" id="department_id" value="">
							<label class="form-label">Categories:</label>
							<div id="dynamic_field">
								<div class="row">
									<div class="col-sm-12 d-flex">
										<input type="text" name="category[]" placeholder="Enter your Category" class="form-control name_list"/>
										<a name="add" id="add" class="ml-1 my-2"><i class="fa fa-plus-circle text-success button-style"></i></a>
									</div>
								</div>
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add New Category</button>
					</form>
				</div>
			</div>
		</div>
	</div>


	<!--row closed-->
</div>
<!--End side app-->
@endsection

@section('additional_scripts')
<script type="text/javascript">
$('#categoryModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget)
		var department_id = button.data('departmentid')
		var modal = $(this)
		modal.find('.modal-body #department_id').val(department_id);
})
</script>
<!--Accordion-Wizard-Form js-->
<!-- <script src="../assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script> -->
<script src="{{ asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>
<script src="../assets/plugins/notify/js/notifIt.js"></script>
<script src="../assets/plugins/select2/select2.full.min.js"></script>
<script src="{{ asset('js/department_list.js') }}"></script>

@endsection
