@extends('layouts.app')

@section('content')
<!-- side app-->
<div class="side-app">
	@if(Auth::user()->canModarateTickets())
		<div class="bg-white p-3 header-secondary row">
			<div class="col">
				<!-- <div class="d-flex">
					<a class="btn btn-danger" href="#"><i class="fe fe-rotate-cw mr-1 mt-1"></i> Upgrade </a>
				</div> -->

			</div>

				<div class="col col-auto">
					<!-- <a class="btn btn-light mt-4 mt-sm-0" href="#"><i class="fe fe-help-circle mr-1 mt-1"></i>  Support</a> -->
					<a class="btn btn-success mt-4 mt-sm-0" href="{{route('ticket.create')}}"><i class="fe fe-plus mr-1 mt-1"></i> Add Ticket</a>
				</div>

		</div>
	@endif
	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->

	<div class="row">
		<div class="col-md-12">
			<div class="owl-carousel owl-carousel2 owl-theme mb-5">


		@if(count($solved) != 0)
			@foreach($solved as $item)
			<div class="item">
				<div class="card mb-0">
					<div class="row">
						<div class="col-4">
							<div class="feature">
								<div class="fa-stack fa-lg fa-2x icon bg-warning-transparent">
									<i class="fa fa-ticket fa-stack-1x text-warning"></i>
								</div>
							</div>
						</div>
						<div class="col-8">
							<div class="card-body p-3 d-flex">
								<div>
									@php
										$value = str_limit($item->title, 12);
									@endphp
									<p class="text-muted mb-1">{{ $value }}</p>
									<h4 class="mb-0 text-dark">{{ $item->created_at->format('d.m.Y') }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		 @endforeach
		@endif
		@if(count($close) != 0)
		 @foreach($close as $item)
			<div class="item">
				<div class="card mb-0">
					<div class="row">
						<div class="col-4">
							<div class="feature">
								<div class="fa-stack fa-lg fa-2x icon bg-danger-transparent">
									<i class="fa fa-ticket fa-stack-1x text-danger"></i>
								</div>
							</div>
						</div>
						<div class="col-8">
							<div class="card-body p-3  d-flex">
								<div>
									@php
										$value = str_limit($item->title, 12);
									@endphp
									<p class="text-muted mb-1">{{ $value }}</p>
									<h4 class="mb-0 text-dark">{{ $item->created_at->format('d.m.Y') }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		 @endforeach
		@endif
		@if(count($open) != 0)
		 @foreach($open as $item)
			<div class="item">
				<div class="card mb-0">
					<div class="row">
						<div class="col-4">
							<div class="feature">
								<div class="fa-stack fa-lg fa-2x icon bg-success-transparent">
									<i class="fa fa-ticket fa-stack-1x text-success"></i>
								</div>
							</div>
						</div>
						<div class="col-8">
							<div class="card-body p-3  d-flex">
								<div>
									@php
										$value = str_limit($item->title, 12);
									@endphp
									<p class="text-muted mb-1">{{ $value }}</p>
									<h4 class="mb-0 text-dark">{{ $item->created_at->format('d.m.Y') }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		 @endforeach
		@endif




			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card card-bgimg br-7">
				<div class="row">
					<div class="col-xl-2 col-lg-6 col-sm-6 pr-0 pl-0">
						<div class="card-body text-center">
							<h5 class="text-white">Today</h5>
							<h2 class="mb-2 mt-3 fs-2 text-white mainvalue">{{ $today }}</h2>
							 <div><i class="si si-graph mr-1 text-danger"></i><span class="text-white">Generated</span></div>
						</div>
					</div>
					<div class="col-xl-2 col-lg-6 col-sm-6 pr-0 pl-0">
						<div class="card-body text-center">
							<h5 class="text-white">Yesterday</h5>
							<h2 class="mb-2 mt-3 fs-2 text-white mainvalue">{{ $yesterday }}</h2>
							 <div><i class="si si-graph mr-1 text-danger"></i><span class="text-white">Generated</span></div>
						</div>
					</div>
					<div class="col-xl-2 col-lg-6 col-sm-6 pr-0 pl-0">
						<div class="card-body text-center">
							<h5 class="text-white">Last Week</h5>
							<h2 class="mb-2 mt-3 fs-2 text-white mainvalue">{{ $lastWeek }}</h2>
							 <div><i class="si si-graph mr-1 text-danger"></i><span class="text-white">Generated</span></div>
						</div>
					</div>
					<div class="col-xl-2 col-lg-6 col-sm-6 pr-0 pl-0">
						<div class="card-body text-center">
							<h5 class="text-white">Last Month</h5>
							<h2 class="mb-2 mt-3 fs-2 text-white mainvalue">{{ $lastMonth }}</h2>
							 <div><i class="si si-graph mr-1 text-danger"></i><span class="text-white">Generated</span></div>
						</div>
					</div>
					<div class="col-xl-2 col-lg-6 col-sm-6 pr-0 pl-0">
						<div class="card-body text-center">
							<h5 class="text-white">Last 6Months</h5>
							<h2 class="mb-2 mt-3 fs-2 text-white mainvalue">{{ $lastSixMonth }}</h2>
							 <div><i class="si si-graph mr-1 text-danger"></i><span class="text-white">Generated</span></div>
						</div>
					</div>
					<div class="col-xl-2 col-lg-6 col-sm-6 pr-0 pl-0">
						<div class="card-body text-center">
							<h5 class="text-white">Last Year</h5>
							<h2 class="mb-2 mt-3 fs-2 text-white mainvalue">{{ $lastYear }}</h2>
							 <div><i class="si si-graph mr-1 text-danger"></i><span class="text-white">Generated</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl-7 col-lg-12 col-md-12">
			<div class="card">
				<div class="card-header custom-header">
					<div>
						<h3 class="card-title">  Created Ticket Overview</h3>
						<h6 class="card-subtitle">Overview of Today's Ticket</h6>
					</div>
					<div class="card-options">
						<a href="" class="mr-4 text-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
							<span class="fa fa-ellipsis-v"></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-right" role="menu">
							<li><a href="#"><i class="si si-plus mr-2"></i>Add</a></li>
							<li><a href="#"><i class="si si-trash mr-2"></i>Remove</a></li>
							<li><a href="#"><i class="si si-eye mr-2"></i>View</a></li>
							<li><a href="#"><i class="si si-settings mr-2"></i>More</a></li>
						</ul>
					</div>
				</div>
				<div class="card-body">
					<div style="height: 210px;">
						<!-- <canvas id="conversion" class="chart-drop"></canvas> -->
						{!! $chart->container() !!}
						{!! $chart->script() !!}
					</div>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-xl-3 col-lg-6 col-sm-6">
							<div class="text-center mt-0">
								<h5 class="mb-1 text-muted">Total Created</h5>
								<h2 class="mb-0 mt-2 fs-2 text-dark mainvalue">{{ $totalTicket }}</h2>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6 col-sm-6">
							<div class="text-center mt-4 mt-sm-0">
								<h5 class="mb-1 text-muted">Total Closed</h5>
								<h2 class="mb-0 mt-2 fs-2 text-dark mainvalue">{{ $totalClosed }}</h2>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6 col-sm-6">
							<div class="text-center mt-4 mt-lg-0">
								<h5 class="mb-1 text-muted">Total Solved</h5>
								<h2 class="mb-0 mt-2 fs-2 text-dark mainvalue">{{ $totalSolved }}</h2>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6 col-sm-6">
							<div class="text-center mt-4 mt-lg-0">
								<h5 class="mb-1 text-muted">Total Open</h5>
								<h2 class="mb-0 mt-2 fs-2 text-dark mainvalue">{{ $totalOpen }}</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-5 col-lg-12 col-md-12">
			<div class="card">
				<div class="card-header custom-header">
					<div>
						<h3 class="card-title">Todays Tickets</h3>
						<h6 class="card-subtitle">Ticket's</h6>
					</div>
					<div class="card-options">
						<a href="" class="mr-4 text-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
							<span class="fa fa-ellipsis-v"></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-right" role="menu">
							<li><a href="#"><i class="si si-plus mr-2"></i>Add</a></li>
							<li><a href="#"><i class="si si-trash mr-2"></i>Remove</a></li>
							<li><a href="#"><i class="si si-eye mr-2"></i>View</a></li>
							<li><a href="#"><i class="si si-settings mr-2"></i>More</a></li>
						</ul>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<div class="chart-circle mt-2 mb-2" data-value="0.80" data-thickness="10" data-color="#1753fc">
								<div class="chart-circle-value"><div class="fs-2">80% </div></div>
							</div>
						</div>
						<div class="col-md-8">
							<h4 class="mb-5">Todays Issues</h4>
							<div class="mb-5">
								<h5 class="mb-2 d-block">
									<span class="fs-16"><b>{{ $todayClosed }}</b> Completed Issues</span>
									<span class="float-right">{{ $todayPercentageOfCompleteIssue }}%</span>
								</h5>
								<div class="progress progress-md h-1">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-primary w-{{ $todayPercentageOfCompleteIssue }}"></div>
								</div>
							</div>
							<div class="mb-0">
								<h5 class="mb-2 d-block">
									<span class="fs-16"><b>{{ $todayOpen + $todaySolved }}</b> Incomplete Issues</span>
									<span class="float-right">{{ $todayPercentageOfIncompleteIssue }}%</span>
								</h5>
								<div class="progress progress-md h-1">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-danger w-{{ $todayPercentageOfIncompleteIssue }}"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-8">
							<h4 class="mb-5">Total Issues</h4>
							<div class="mb-5">
								<h5 class="mb-2 d-block">
									<span class="fs-16"><b>{{ $totalClosed }}</b> Completed Issues</span>
									<span class="float-right">{{ $percentageOfCompleteIssue }}%</span>
								</h5>
								<div class="progress progress-md h-1">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-primary w-{{ $percentageOfCompleteIssue }}"></div>
								</div>
							</div>
							<div class="mb-0">
								<h5 class="mb-2 d-block">
									<span class="fs-16"><b>{{ $totalOpen + $totalSolved }}</b> Incompleted Issues</span>
									<span class="float-right">{{ $percentageOfIncompleteIssue }}%</span>
								</h5>
								<div class="progress progress-md h-1">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-danger w-{{ $percentageOfIncompleteIssue }}"></div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="chart-circle mt-2" data-value="0.30" data-thickness="10" data-color="#e34a42">
								<div class="chart-circle-value"><div class="fs-2">30% </div></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@if(Auth::user()->canModarateTickets())
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header ">
					<h3 class="card-title ">Company/Department List</h3>
					@if(Auth::user()->isMasterAdmin())
						<div class="card-options">
							<a id="add__new__list" href="{{route('department.create')}}"  class="btn btn-sm btn-primary text-light"><i class="fa fa-plus"></i> Add a new Company</a>
						</div>
					@endif
				</div>
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
							@foreach($recentDepartment as $dept)
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
	</div>
@endif
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card">
				<div class="card-header custom-header">
					<div>
						<h3 class="card-title">Recently Updated Tickets</h3>
						<h6 class="card-subtitle">Over of this week</h6>
					</div>
					<div class="card-options">
						<a href="" class="mr-4 text-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
							<span class="fa fa-ellipsis-v"></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-right" role="menu">
							<li><a href="#"><i class="si si-plus mr-2"></i>Add</a></li>
							<li><a href="#"><i class="si si-trash mr-2"></i>Remove</a></li>
							<li><a href="#"><i class="si si-eye mr-2"></i>View</a></li>
							<li><a href="#"><i class="si si-settings mr-2"></i>More</a></li>
						</ul>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered text-nowrap mb-0">
							<thead>
								<tr>
									<th class="wd-20p">#ID</th>
									<th class="wd-20p">Ticket Title</th>
									<th class="wd-15p">Department</th>
									<th class="wd-15p">Category</th>
									<th class="wd-10p">Priority</th>
									<th class="wd-10p">Created Date</th>
									<th class="wd-10p">View</th>
								</tr>
							</thead>
							<tbody>
									@foreach($recentTicketList as $ticket)
									<tr>
										<th scope="row">{{ $ticket->id }}</th>
										<td>{{ $ticket->title }}</td>
										<td>{{ $ticket->department->name }}</td>
										<td>{{ $ticket->ticketCategory->category ?? "Other" }}</td>
										<td>{!! App\Ticket::getTicketPriorityString($ticket->priority) !!}</td>
										<td>{{ $ticket->created_at->format('d.m.Y') }}</td>
										<td>
											<a href="{{ route('ticket.display',$ticket->id) }}" class="btn btn-sm btn-primary">view</a>
										</td>
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
<!--End side app-->

@endsection
