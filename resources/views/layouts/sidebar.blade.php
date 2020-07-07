<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
	<div class="app-sidebar__user pb-0">
		<div class="user-body">
			<span class="avatar avatar-xxl brround text-center cover-image" data-image-src="{{asset('assets/images/users/pyke.jpg')}}"></span>
		</div>
		<div class="user-info">
			<a href="#" class="ml-2">
				<span class="text-dark app-sidebar__user-name font-weight-semibold">{{Auth::user()->name}}</span>
				<br>
				@php
					 if(Auth::user()->canDepartmentAdmin()){
						 $dep = App\Department::where('user_id',Auth::user()->id)->first();
					 }
				@endphp
				@if(Auth::user()->isMasterAdmin())
					<span class="text-muted app-sidebar__user-name text-sm"> (Admin)</span>
				@endif
				@if(Auth::user()->isAgent())
					<span class="text-muted app-sidebar__user-name text-sm"> (Agent)</span>
				@endif
				@if(Auth::user()->canDepartmentAdmin())
					<span class="text-muted app-sidebar__user-name text-sm"> {{ $dep->name }} <br> (Department)</span>
				@endif
			</a>
		</div>
	</div>

	<div class="tab-menu-heading siderbar-tabs border-0 p-0">
		<div class="tabs-menu ">
			<!-- Tabs -->
			<ul class="nav panel-tabs">
				<li class=""><a href="#index1" class="active" data-toggle="tab"><i class="fa fa-home fs-17"></i></a></li>
				<li><a href="#index2" data-toggle="tab"><i class="fa fa-briefcase fs-17"></i></a></li>
				<li><a href="#index3" data-toggle="tab"><i class="fa fa-user fs-17"></i></a></li>
				<li><a href="{{ route('logout') }}" title="logout"><i class="fa fa-power-off fs-17"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="panel-body tabs-menu-body side-tab-body p-0 border-0 ">
		<div class="tab-content">
			<div class="tab-pane active" id="index1">
				<div class="row row-demo-list">
					<div id="parentVerticalTab" class="col-md-12">
						<ul class="resp-tabs-list hor_1">
							<li class="resp-tab-item hor_1 {{Request::is('home') || Request::is('profile') ? 'resp-tab-active': ''}}"><i class="side-menu__icon typcn typcn-device-desktop" data-toggle="tooltip" title="si-user-follow"></i></li>
							@if(Auth::user()->canModarateTickets())
								<li class="resp-tab-item hor_1 {{Request::is('ticket') || Request::is('ticket/*') ? 'resp-tab-active': ''}}"><i class="side-menu__icon typcn typcn-keyboard" data-toggle="tooltip" title="si-user-follow"></i></li>
							@endif
							@if(Auth::user()->isMasterAdmin() || Auth::user()->canDepartmentAdmin())
								<li class="resp-tab-item hor_1 {{Request::is('department') || Request::is('department/*') ? 'resp-tab-active': ''}}"><i class="side-menu__icon typcn typcn-folder"data-toggle="tooltip" title="si-user-follow"></i></li>
							@endif
							@if(Auth::user()->isMasterAdmin())
								<li class="resp-tab-item hor_1 {{Request::is('agent') || Request::is('agent/*') ? 'resp-tab-active': ''}}"><i class="si si-user-follow" data-toggle="tooltip" title="si-user-follow"></i></li>
							@endif
							@if(Auth::user()->isMasterAdmin() || Auth::user()->canDepartmentAdmin())
								<li class="resp-tab-item hor_1 {{Request::is('employee') || Request::is('employee/*') ? 'resp-tab-active': ''}}"><i class="si si-people" data-toggle="tooltip" title="si-user-follow"></i></li>
							@endif
						</ul>
						<div class="resp-tabs-container hor_1">
							<div class="{{Request::is('home') || Request::is('profile') ? 'resp-tab-content-active': ''}}">
								<div class="row">
									<div class="col-md-12">
										<h4 class="font-weight-semibold">Home</h4>
                    <a class="slide-item" href="{{route('home')}}"> Dashboard</a>
										<a class="slide-item" href="{{route('profile')}}"> Profile</a>
										<a class="slide-item" href="index2.html"> Notifications</a>
									</div>
								</div>
							</div>
							@if(Auth::user()->canModarateTickets() || Auth::user()->canDepartmentAdmin())
							<div class="{{Request::is('ticket') || Request::is('ticket/*') ? 'resp-tab-content-active': ''}}">
								<div class="row">
									<div class="col-md-12">
										<h4 class="font-weight-semibold">Tickets</h4>
										@if(Auth::user()->canModarateTickets())
											<a class="slide-item" href="{{route('ticket.create')}}">Create Ticket</a>
										@endif
										@if(Auth::user()->isMasterAdmin())
											<a class="slide-item" href="{{route('ticket.all_tickets')}}">All Tickets </a>
										@endif
										<a class="slide-item" href="{{route('ticket.open_tickets')}}">Open Tickets</a>
										<a class="slide-item" href="{{route('ticket.solved_tickets')}}">Solved Tickets</a>
										<a class="slide-item" href="{{route('ticket.closed_tickets')}}">Closed Tickets</a>
									</div>
								</div>
							</div>
							@endif
							@if(Auth::user()->canModarateTickets())
              <div class="{{Request::is('department') || Request::is('department/*') ? 'resp-tab-content-active': ''}}">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="font-weight-semibold">Depatrments</h4>
										@if(Auth::user()->isMasterAdmin())
                    	<a class="slide-item" href="{{route('department.create')}}">Create Department</a>
										@endif
                    <a class="slide-item" href="{{route('department.all_departments')}}">Department List </a>
                  </div>
                </div>
              </div>
							@endif
							@if(Auth::user()->isMasterAdmin())
							<div class="{{Request::is('agent') || Request::is('agent/*') ? 'resp-tab-content-active': ''}}">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="font-weight-semibold">Agents</h4>
                    <a class="slide-item" href="{{route('agent.create')}}">Create Agents</a>
                    <a class="slide-item" href="{{route('agent.list')}}">Agent List </a>
                  </div>
                </div>
              </div>
							@endif
							@if(Auth::user()->isMasterAdmin() || Auth::user()->canDepartmentAdmin())
							<div class="{{Request::is('employee') || Request::is('employee/*') ? 'resp-tab-content-active': ''}}">
								<div class="row">
									<div class="col-md-12">
										<h4 class="font-weight-semibold">Employees</h4>
										<a class="slide-item" href="{{route('employee.create')}}">Create Employees</a>
										<a class="slide-item" href="{{route('employee.all_employees')}}">Employee List </a>
									</div>
								</div>
							</div>
							@endif
						</div>
					</div>
				</div><!-- col-4 -->
			</div>
			<div class="tab-pane border-top" id="index2">
				<div class="list-group list-group-transparent mb-0 mail-inbox">
					<div class="mt-3 mb-3 ml-3 mr-3 text-center">
						<a href="email.html" class="btn btn-primary btn-block"><i class="typcn typcn-pencil fs-14"></i> <span class="email-text">Departments</span></a>
					</div>
					<a href="emailservices.html" class="list-group-item list-group-item-action d-flex align-items-center">
						<span class="icon mr-3"><i class="fe fe-inbox"></i></span><span class="email-text">JHOROTEK</span> <span class="ml-auto badge-pill badge badge-success email-text">05</span>
					</a>
					<a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
						<span class="icon mr-3"><i class="fe fe-send"></i></span><span class="email-text">Five R</span>
					</a>
					<a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
						<span class="icon mr-3"><i class="fe fe-alert-circle"></i></span><span class="email-text">SM Communication</span> <span class="ml-auto badge-pill badge badge-danger email-text">01</span>
					</a>
					<a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
						<span class="icon mr-3"><i class="fe fe-star"></i></span><span class="email-text">Shuru Campus</span>
					</a>
					<a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
						<span class="icon mr-3"><i class="fe fe-file"></i></span><span class="email-text">Uttora Motors</span>
					</a>
					<a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
						<span class="icon mr-3"><i class="fe fe-tag"></i></span><span class="email-text">Joy Calls</span>
					</a>
					<a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
						<span class="icon mr-3"><i class="fe fe-trash-2"></i></span><span class="email-text"> Infobip</span>
					</a>
				</div>
			</div>
			<div class="tab-pane border-top" id="index3">
				<div class="list-group list-group-flush ">
					<form class="form-inline p-4 m-0">
						<div class="search-element">
							<input class="form-control header-search w-100" type="search" placeholder="Search..." aria-label="Search">
							<span class="Search-icon"><i class="fa fa-search"></i></span>
						</div>
					</form>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/female/12.jpg"><span class="avatar-status bg-green"></span></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Mozelle Belt</div>
						</div>
					</div>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/female/21.jpg"></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Florinda Carasco</div>
						</div>
					</div>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/female/29.jpg"><span class="avatar-status bg-green"></span></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Alina Bernier</div>
						</div>
					</div>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/female/2.jpg"><span class="avatar-status bg-green"></span></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Zula Mclaughin</div>
						</div>
					</div>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/male/34.jpg"></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Isidro Heide</div>
						</div>
					</div>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/male/12.jpg"><span class="avatar-status bg-green"></span></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Mozelle Belt</div>
						</div>
					</div>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/male/21.jpg"></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Florinda Carasco</div>
						</div>
					</div>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/male/29.jpg"></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Alina Bernier</div>
						</div>
					</div>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/male/2.jpg"></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Zula Mclaughin</div>
						</div>
					</div>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/female/14.jpg"><span class="avatar-status bg-green"></span></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Isidro Heide</div>
						</div>
					</div>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/male/11.jpg"></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Florinda Carasco</div>
						</div>
					</div>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/male/9.jpg"></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Alina Bernier</div>
						</div>
					</div>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/male/22.jpg"><span class="avatar-status bg-green"></span></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Zula Mclaughin</div>
						</div>
					</div>
					<div class="list-group-item d-flex  align-items-center">
						<div class="mr-2">
							<span class="avatar avatar-md brround cover-image" data-image-src="../assets/images/users/female/4.jpg"></span>
						</div>
						<div class="user-name">
							<div class="font-weight-semibold">Isidro Heide</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</aside>
				<!--sidemenu end-->
