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
			<li class="breadcrumb-item"><a href="{{route('employee.all_employees')}}">Employee List</a></li>
  		<li class="breadcrumb-item active" aria-current="page">Employee Details</li>
  	</ol><!-- End breadcrumb -->
  </div>
  <!-- End page-header -->
    <!--  Main card profile  -->
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
                    <h2 class="text-primary">Employee Profile</h2> <h5 class="text-primary"><sup><i class="fa fa-info-circle"></i></sup></h5>
                  </div>
                   <div class="row">
                     <div class="col-12">
                      <h5>
                          <strong class="text-primary">Department Name:</strong> {{ $employee->department->name }}
                      </h5>
                      <hr class="my-2">
                     </div>
                     <div class="col-12">
											 <div class="row">
											 		<div class="col-md-6">
														<h5>
		 													<strong class="text-primary">Name :</strong> {{ $employee->name }}
		 												</h5>
		 												<hr class="my-2">
											 		</div>
													<div class="col-md-6">
														<h5>
															<strong class="text-primary">Mobile No. :</strong> {{ $employee->mobile_no }}
														</h5>
														<hr class="my-2">
													</div>
											 </div>
                     </div>
										 <div class="col-12">
											 <h5>
											 	<strong class="text-primary">Email :</strong> {{ $employee->email }}
											 </h5>
											 <hr class="my-2">
										 </div>
                   </div>
                </div><!--col-md-7 -->
                <div class="col-md-4 justify-content-center">
                  <div class="row justify-content-center mt-3">
                    <div class="col-12">
                      <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-pill btn-info btn-sm float-right">
                        <i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit profile
                      </a>
                    </div>
                  </div>
									<div class="row mt-6">
										<div class="col-12">
											<hr class="my-2">
											<h6 class="text-center">
												<i class="si si-exclamation text-primary"></i> {{ count($openTickets) }} <span class="text-secondary">Open Ticket</span>
											</h6>
											<hr class="my-2">
											<h6 class="text-center">
												<i class="si si-close text-primary"></i> {{ count($closeTickets) }} <span class="text-secondary">Close Ticket</span>
											</h6>
											<hr class="my-2">
										</div>
									</div>
              </div>
            </div>
          </div>
         </div>
        </div>
      </div>
    </div>

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
