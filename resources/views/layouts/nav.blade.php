<!--app-header-->
<div class="app-header header d-flex">
	<div class="container-fluid">
		<div class="d-flex">
			<a class="header-brand" href="index.html">
				<img src="{{ asset('assets/images/brand/service_chai.png') }}" class="header-brand-img main-logo" alt="service chai logo" style=" max-width: 60%;">
				<!-- <img src="../assets/images/brand/icon.png" class="header-brand-img icon-logo" alt="Hogo logo"> -->
			</a><!-- logo-->
			<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
			<a href="#" data-toggle="search" class="nav-link nav-link  navsearch"><i class="fa fa-search"></i></a><!-- search icon -->
			<div class="header-form">
				<form class="form-inline">
					<div class="search-element mr-3">
						<input class="form-control" type="search" placeholder="Search" aria-label="Search">
						<span class="Search-icon"><i class="fa fa-search"></i></span>
					</div>
				</form><!-- search-bar -->
			</div>
			<ul class="nav navbar-nav horizontal-nav header-nav">
				<li class="mega-dropdown nav-item">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<i class="fe fe-grid mr-2"></i>UI Kit <i class="fa fa-angle-down ml-1"></i>
					</a>
					<ul class="dropdown-menu mega-dropdown-menu container row p-5">
						<li>
							<div class="row">
								<div class="col-md-4">
									<div class="">
										<div class="card-body p-0 relative">
											<div class="arrow-ribbon">Comming Events</div>
											<img class="" alt="img" src="../assets/images/photos/32.jpg">
											<div class="btn-absolute">
												<a class="btn btn-primary btn-pill btn-sm" href="#">More info</a>
												<span id="timer-countercallback1" class="h5 text-white float-right mb-0 mt-1"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-2">
									<h4  class="mb-3">Pages</h4>
									<a class="dropdown-item pl-0 pr-0" href="#"><i class="fa fa-angle-double-right text-muted mr-1"></i> Client Support</a>
									<a class="dropdown-item pl-0 pr-0" href="#"><i class="fa fa-angle-double-right text-muted mr-1"></i> About Us</a>
									<a class="dropdown-item pl-0 pr-0" href="#"><i class="fa fa-angle-double-right text-muted mr-1"></i> Calendar</a>
									<a class="dropdown-item pl-0 pr-0" href="#"><i class="fa fa-angle-double-right text-muted mr-1"></i> Add New Pages</a>
									<a class="dropdown-item pl-0 pr-0" href="#"><i class="fa fa-angle-double-right text-muted mr-1"></i> Login Pages</a>
								</div>
								<div class="col-2">
									<h4  class="mb-3">Pages</h4>
									<a class="dropdown-item pl-0 pr-0" href="#"><i class="fa fa-angle-double-right text-muted mr-1"></i> Documentation</a>
									<a class="dropdown-item pl-0 pr-0" href="#"><i class="fa fa-angle-double-right text-muted mr-1"></i> Multi Pages</a>
									<a class="dropdown-item pl-0 pr-0" href="#"><i class="fa fa-angle-double-right text-muted mr-1"></i> Edit Profile</a>
									<a class="dropdown-item pl-0 pr-0" href="#"><i class="fa fa-angle-double-right text-muted mr-1"></i> Mail Settings</a>
									<a class="dropdown-item pl-0 pr-0" href="#"><i class="fa fa-angle-double-right text-muted mr-1"></i> Default Setting</a>
								</div>
								<div class="col-md-4">
									<h4  class="mb-3">Current projects</h4>
									<div class="overflow-hidden">
										<div class="card-body p-0">
											<div class="list-group list-lg-group list-group-flush">
												<a class="list-group-item list-group-item-action overflow-hidden pl-0 pr-0 pb-4" href="#">
													<div class="d-flex">
														<img class="avatar-xl br-7 mr-3" src="../assets/images/photos/33.jpg" alt="Image description">
														<div class="media-body">
															<div class="align-items-center">
																<h5 class="mb-0">
																	Wordpress project
																</h5>
															</div>
															<div class="mb-2 mt-2">
																<p class="mb-2">Project Status<span class="float-right text-default">85%</span></p>
																<div class="progress progress-sm mb-0 h-1">
																	<div class="progress-bar progress-bar-striped progress-bar-animated bg-success w-85"></div>
																</div>
															</div>
														</div>
													</div>
												</a>
												<a class="list-group-item list-group-item-action overflow-hidden pl-0 pr-0 pt-4" href="#">
													<div class="d-flex">
														<img class="avatar-xl br-7 mr-3" src="../assets/images/photos/34.jpg" alt="Image description">
														<div class="media-body">
															<div class="align-items-center">
																<h5 class="mb-0">
																	Html project
																</h5>
															</div>
															<div class="mb-2 mt-2">
																<p class="mb-2">Project Status<span class="float-right text-default">75%</span></p>
																<div class="progress progress-sm mb-0 h-1">
																	<div class="progress-bar progress-bar-striped progress-bar-animated bg-primary w-75"></div>
																</div>
															</div>
														</div>
													</div>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</li>
			</ul>
			<ul class="nav header-nav">
				<li class="nav-item dropdown header-option m-2">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<i class="fe fe-settings mr-2"></i>Settings
					</a>
					<div class="dropdown-menu dropdown-menu-left">
						<a class="dropdown-item" href="#">Change Password</a>
						<a class="dropdown-item" href="#">Change Email</a>
						<a class="dropdown-item" href="#">Option 3</a>
						<a class="dropdown-item" href="#">Option 4</a>
						<a class="dropdown-item" href="#">Option 5</a>

					</div>
				</li>
			</ul>
			<div class="d-flex order-lg-2 ml-auto header-rightmenu">
				<div class="dropdown">
					<a  class="nav-link icon full-screen-link" id="fullscreen-button">
						<i class="fe fe-maximize-2"></i>
					</a>
				</div><!-- full-screen -->
				<div class="dropdown header-notify">
					<a class="nav-link icon" data-toggle="dropdown" aria-expanded="false">
						<i class="fe fe-bell "></i>
						<span class="pulse bg-success"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
						<a href="#" class="dropdown-item text-center">4 New Notifications</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item d-flex pb-3">
							<div class="notifyimg bg-green">
								<i class="fe fe-mail"></i>
							</div>
							<div>
								<strong>Ticket Completed.</strong>
								<div class="small text-muted">12 mins ago</div>
							</div>
						</a>
						<a href="#" class="dropdown-item d-flex pb-3">
							<div class="notifyimg bg-pink">
								<i class="fe fe-shopping-cart"></i>
							</div>
							<div>
								<strong>Ticket sent to jhorotek</strong>
								<div class="small text-muted">2  hour ago</div>
							</div>
						</a>
						<a href="#" class="dropdown-item d-flex pb-3">
							<div class="notifyimg bg-blue">
								<i class="fe fe-calendar"></i>
							</div>
							<div>
								<strong>New Comments</strong>
								<div class="small text-muted">1  hour ago</div>
							</div>
						</a>
						<a href="#" class="dropdown-item d-flex pb-3">
							<div class="notifyimg bg-orange">
								<i class="fe fe-monitor"></i>
							</div>
							<div>
								<strong>Your Admin Lanuch</strong>
								<div class="small text-muted">2  days ago</div>
							</div>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item text-center">View all Notifications</a>
					</div>
				</div><!-- notifications -->
				<a class="nav-link leading-none siderbar-link"  data-toggle="sidebar-right" data-target=".sidebar-right">
					<span class="mr-3 d-none d-lg-block ">
						<span class="text-gray-white"><span class="ml-2">{{Auth::user()->name}}</span></span>
					</span>
					<span class="avatar avatar-md brround"><img src="{{asset('assets/images/users/pyke.jpg')}}" alt="Profile-img" class="avatar avatar-md brround"></span>
				</a>
				<div class="dropdown">
					<a  class="nav-link icon siderbar-link" data-toggle="sidebar-right" data-target=".sidebar-right">
						<i class="fe fe-more-horizontal"></i>
					</a>
				</div><!-- Right-siebar-->
			</div>
		</div>
	</div>
</div>
<!--app-header end-->

<!-- Right-sidebar-->
<div class="sidebar sidebar-right sidebar-animate">
	<div class="tab-menu-heading siderbar-tabs border-0">
		<div class="tabs-menu ">
			<!-- Tabs -->
			<ul class="nav panel-tabs">
				<!-- <li class=""><a href="#tab"  class="active" data-toggle="tab">Profile</a></li> -->
				<!-- <li class=""><a href="#tab1" data-toggle="tab">Chat</a></li>
				<li><a href="#tab2" data-toggle="tab">Activity</a></li>
				<li><a href="#tab3" data-toggle="tab">Todo</a></li> -->
			</ul>
		</div>
	</div>
	<div class="panel-body tabs-menu-body side-tab-body p-0 border-0 ">
		<div class="tab-content border-top">
			<div class="tab-pane active " id="tab">
				<div class="card-body p-0">
					<div class="header-user text-center mt-4 pb-4">
						<span class="avatar avatar-xxl brround"><img src="{{asset('assets/images/users/pyke.jpg')}}" alt="Profile-img" class="avatar avatar-xxl brround"></span>
						<div class="dropdown-item text-center font-weight-semibold user h3 mb-0">{{Auth::user()->name}}</div>
						@if(Auth::user()->access_level == 'master_admin')
							<small>Admin</small>
						@elseif(Auth::user()->access_level == 'department_admin')
								<small>Department</small>
						@elseif(Auth::user()->access_level == 'agent')
								<small>Agent</small>
						@endif
					</div>
					@if(Auth::user()->canModarateTickets())
	          <a class="dropdown-item  border-top" href="{{route('ticket.create')}}">
	            <i class="dropdown-icon mdi mdi-account-outline "></i> Create Ticket
	          </a>
					@endif
					@if(Auth::user()->isMasterAdmin())
						<a class="dropdown-item  border-top" href="{{route('agent.create')}}">
							<i class="dropdown-icon mdi mdi-account-outline "></i> Create Agents
						</a>
						<a class="dropdown-item border-top" href="{{route('department.create')}}">
							<i class="dropdown-icon  mdi mdi-account-plus"></i> Create Department
						</a>
					@endif
					<div class="card-body border-top">
						<div class="row">
							<div class="col-4 text-center">
								<a class="" href="{{route('notification.index')}}"><i class="dropdown-icon mdi  mdi-message-outline fs-30 m-0 leading-tight"></i></a>
								<div>Notifications</div>
							</div>
							<div class="col-4 text-center">
								<a class="" href=""><i class="dropdown-icon mdi mdi-tune fs-30 m-0 leading-tight"></i></a>
								<div>Settings</div>
							</div>
							<div class="col-4 text-center">
								<a class="" href="{{ route('logout') }}"><i class="dropdown-icon mdi mdi-logout-variant fs-30 m-0 leading-tight"></i></a>
								<div>Sign out</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Rightsidebar-->
