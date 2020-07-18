@extends('layouts.app')

@section('additional_headers')

@endsection


@section('content')
<div class="side-app">

	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Own Profile</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->


<div class="row">
  <div class="col-md-12">
    <div class="card card-profile  overflow-hidden">
		@if($user->access_level == 'master_admin')
      <div class="card-body text-center bg-gradient-primary">
		@elseif($user->access_level == 'department_admin')
			<div class="card-body text-center bg-gradient-secondary">
		@elseif($user->access_level == 'agent')
			<div class="card-body text-center bg-gradient-success">
		@endif
        <div class=" card-profile">
          <div class="row justify-content-center">
            <div class="">
              <div class="">
                <a href="#">
									@if($user->access_level == 'master_admin')
                  	<img src="{{asset('assets/images/users/female/admin_person.jpg')}}" class="avatar-xxl rounded-circle" alt="profile">
									@elseif($user->access_level == 'department_admin')
										<img src="{{asset('assets/images/users/female/department_admin.jpg')}}" class="avatar-xxl rounded-circle" alt="profile">
									@elseif($user->access_level == 'agent')
										<img src="{{asset('assets/images/users/female/agent.jpg')}}" class="avatar-xxl rounded-circle" alt="profile">
									@endif
								</a>
              </div>
            </div>
          </div>
        </div>
        <h3 class="mt-3 text-white">{{ $user->name }}</h3>
				@if($user->access_level == 'master_admin')
        		<p class="mb-2 text-white">Admin</p>
						<a href="{{route('edit',$user->id)}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit profile</a>
				@elseif($user->access_level == 'department_admin')
						<p class="mb-2 text-white">Department</p>
						<a href="{{route('edit',$user->id)}}" class="btn btn-secondary btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit profile</a>
				@elseif($user->access_level == 'agent')
						<p class="mb-2 text-white">Agent</p>
						<a href="{{route('edit',$user->id)}}" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit profile</a>
				@endif
        </div>
        <div class="card-body">
          <div class="nav-wrapper p-0">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 mt-md-2 mt-0 mt-lg-0 active show" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
									<i class="fa fa-home mr-2"></i>About
								</a>
              </li>

							@if($user->access_level == 'department_admin')
               <li class="nav-item">
                 <a class="nav-link mb-sm-3 mb-md-0 mt-md-2 mt-0 mt-lg-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
									 <i class="fa fa-tags mr-2"></i>Ticket Category
								 </a>
               </li>
							 @endif

               <li class="nav-item">
                 <a class="nav-link mb-sm-3 mb-md-0 mt-md-2 mt-0 mt-lg-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">
									 <i class="fa fa-ticket mr-2 mt-1"></i>Recent Close Tickets
								 </a>
               </li>

							@if($user->access_level == 'department_admin')
               <li class="nav-item">
                 <a class="nav-link mb-sm-3 mb-md-0 mt-md-2 mt-0 mt-lg-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false">
									 <i class="fa fa-user-secret mr-2"></i>Recent Employee
								 </a>
               </li>
							@endif

							@if($user->access_level == 'agent')
               <li class="nav-item">
                 <a class="nav-link mb-sm-0 mb-md-0 mt-md-2 mt-0 mt-lg-0" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false">
									 <i class="fa fa-building mr-2"></i>Department
								 </a>
               </li>
							@endif

							@if($user->access_level == 'master_admin')
							<li class="nav-item">
								<a class="nav-link mb-sm-0 mb-md-0 mt-md-2 mt-0 mt-lg-0" id="tabs-icons-text-6-tab" data-toggle="tab" href="#tabs-icons-text-6" role="tab" aria-controls="tabs-icons-text-6" aria-selected="false">
									<i class="fa fa-ticket mr-2 mt-1"></i>Recent Open Tickets
								</a>
							</li>
							@endif

             </ul>
           </div>
         </div>
       </div>
       <div class="card">
         <div class="card-body pb-0">
           <div class="tab-content" id="myTabContent">
             <div class="tab-pane fade active show" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
							 <h4>
								 <strong>About Me</strong>
							 </h4>
							 <div class="table-responsive mb-3">
                 <table class="table row table-borderless w-100 m-0 border">
                   <tbody class="col-lg-6 p-0">
                     <tr>
                       <td><strong>Full Name :</strong> {{ $user->name }}</td>
                     </tr>
										 @php
										 		if(Auth::user()->canDepartmentAdmin()){
													$dep = App\Department::where('user_id',$user->id)->first();
												}
										 @endphp
                     <tr>
											  @if(Auth::user()->canDepartmentAdmin())
                       		<td><strong>Location :</strong> {{ $dep->address }}</td>
											  @endif
                     </tr>
                     <tr>
											 <td><strong>Phone :</strong> {{ $user->mobile_no }}</td>
                     </tr>
                   </tbody>
                   <tbody class="col-lg-6 p-0">
                     <tr>
											 @if(Auth::user()->canDepartmentAdmin())
												  <td><strong>Department Name :</strong> {{ $dep->name }}</td>
											 @endif
                     </tr>
                     <tr>
                       <td><strong>Email :</strong> {{ $user->email }}</td>
                     </tr>
                     <tr>
                       <td><strong>Created Date :</strong> {{ $user->created_at->format('d.m.Y') }}</td>
                     </tr>
                   </tbody>
                 </table>
               </div>
              </div>

						@if($user->access_level == 'department_admin')
               <div aria-labelledby="tabs-icons-text-2-tab" class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel">
                 <div class="row">
                   <div class="col-md-12">
                     <div class="content content-full-width" id="content"> <!-- begin profile-content -->
                       <div class="profile-content"> <!-- begin tab-content -->
                         <div class="tab-content p-0"> <!-- begin #profile-friends tab -->
                           <div class="tab-pane fade in active show" id="profile-friends">
                             <div class="row row-space-2"> <!-- end col-6 -->

														 		<div class="col-md-12 col-lg-12">
														 			<div class="card">
														 				<div class="card-header">
														 					<h3 class="card-title">Department Ticket Category ({{ count($department->ticketCategories) }})</h3>
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
														 		</div>  <!-- end Col-md-12 -->

                               </div><!-- end row -->
                             </div><!-- end #profile-friends tab -->
                           </div><!-- end tab-content -->
                         </div><!-- end profile-content -->
                       </div>
                     </div>
                   </div>
                 </div>
								@endif

                 <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                   <div class="row">
										 <div class="card">
	 										<div class="card-header">
	 												<h3 class="card-title">Recent Close Tickets</h3>
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
	 									</div>
	                 </div>
	               </div>

						@if($user->access_level == 'department_admin')
                 <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
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
						@endif
						@if($user->access_level == 'agent')
                <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">
									<div class="row profile ng-scope">
										<div class="table-responsive">
											<table class="table card-table table-striped table-vcenter table-outline table-bordered text-nowrap ">
												<thead>
													<tr>
														<th scope="col" class="border-top-0 wd-20p">#ID</th>
														<th scope="col" class="border-top-0 wd-20p">Department</th>
														<th scope="col" class="border-top-0 wd-15p">Name</th>
														<th scope="col" class="border-top-0 wd-10p">Email</th>
														<th scope="col" class="border-top-0 wd-10p">Mobile Number</th>
														<th scope="col" class="border-top-0 wd-20p">Ticket Category</th>
														<th scope="col" class="border-top-0 wd-10p">Created Date</th>
														<th scope="col" class="border-top-0 wd-10p">View</th>
													</tr>
												</thead>
												<tbody>
													@foreach($agentDepartments as $dept)
														<tr>
															<th scope="row">{{ $dept->id }}</th>
															<td>{{ $dept->name }}</td>
															<td>{{ $dept->user->name }}</td>
															<td>{{ $dept->user->email }}</td>
															<td>{{ $dept->user->mobile_no }}</td>
															<td>
																<div class="row">
																	<div class="col-xl-10 col-lg-10 cal-md-10 col-sm-10">
																		<select size="1" class="form-control wd-20p">
																			@foreach($dept->ticketCategories as $ticket_cat)
																				<option value="{{ $ticket_cat->id }}">{{ $ticket_cat->category }}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</td>
															<td>{{ $dept->created_at->format('d.m.Y') }}</td>
															<td><a href="{{ route('department.details',$dept->id) }}" class="btn btn-sm btn-primary">view</a></td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
                </div>
						@endif

					@if($user->access_level == 'master_admin')
						<div class="tab-pane fade" id="tabs-icons-text-6" role="tabpanel" aria-labelledby="tabs-icons-text-6-tab">
							<div class="row">
								<div class="card">
								 <div class="card-header">
										 <h3 class="card-title">Recent Close Tickets</h3>
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
							 </div>
							</div>
						</div>
					@endif

          </div>
        </div>
      </div>
    </div>
  </div>


					<!-- Model start -->
					@if($user->access_level == 'department_admin')
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
					@endif
					<!-- Model Ends -->

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

@endsection
