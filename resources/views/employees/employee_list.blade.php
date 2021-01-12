@extends('layouts.app')

@section('additional_headers')

@endsection

@section('content')

<div class="side-app">
	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="{{route('deshboard.home')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">My Employees</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->
  <div class="row">
  	<div class="col-md-12">
  			<!-- begin profile-content -->
  			<div class="profile-content">
          <!-- begin #profile-friends tab -->
          <div class="tab-pane fade in active show" id="profile-friends">
            <h4 class="mt-0 mb-4">Employees ({{ count($dept_employees) }})</h4><!-- begin row -->
            <div class="row row-space-2">
              @foreach($dept_employees as $item)
              <!-- end col-6 -->
							<div class="col-xl-6">
								<div class="card  mb-5">
									<div class="card-body">
										<div class="media mt-0">
											<figure class="rounded-circle align-self-start mb-0">
												<img src="/employee_image/{{$item->image}}" alt="Generic placeholder image" class="avatar brround avatar-md mr-3">
											</figure>
											<div class="media-body">
												<h5 class="time-title p-0 mb-0 font-weight-semibold leading-normal">{{$item->name}}</h5> {{$item->mobile_no}}
											</div>
											<a href="{{ route('employee.details',$item->id) }}" class="btn btn-primary d-none d-sm-block mr-2"><i class="fa fa-eye"></i> </a>
											<button class="btn btn-success d-none d-sm-block"><i class="fa fa-info"></i> </button>
										</div>
									</div>
									<div class="card-footer text-secondary border-top"> Email: <span class="text-primary">{{$item->email}}</span>
									</div>
								</div>
							</div>
              <!-- end col-6 -->
              @endforeach
            </div><!-- end row -->
          </div><!-- end #profile-friends tab -->
  			</div><!-- end profile-content -->
  	</div>
  </div>
</div>
<!--End side app-->
@endsection

@section('additional_scripts')

@endsection
