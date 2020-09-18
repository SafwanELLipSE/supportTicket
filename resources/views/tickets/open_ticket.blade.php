@extends('layouts.app')

@section('additional_headers')
<!-- Data table css -->
		<link href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
		<link href="{{asset('assets/plugins/select2/select2.min-dark.css')}}" rel="stylesheet" />
		<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

		<link href="{{ asset('assets/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet" />
@endsection


@section('content')

<div class="side-app">

	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="{{route('deshboard.home')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Open Tickets</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->

  <div class="row">
    <div class="col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Open Tickets</div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="ticket_table" class="table table-striped table-bordered text-nowrap w-100">
              <thead>
                <tr>
                  <th class="wd-10p">#ID</th>
                  <th class="wd-20p"> Ticket Title</th>
                  <th class="wd-15p">
										<select class="form-control select2-show-search" id="department">
												<option value="" selected>Department</option>
												@foreach($departments as $item)
													<option value="{{$item->id}}">{{$item->name}}</option>
												@endforeach
										</select>
									</th>
                  <th class="wd-15p">Category</th>
                  <th class="wd-10p">
										<select class="form-control select2" id="priority">
												<option value="" selected>Priority</option>
												<option value="1">Minor</option>
												<option value="2">Major</option>
												<option value="3">Critical</option>
										</select>
									</th>
                  <!-- <th class="wd-10p">
										<select class="form-control select2-show-search" id="creator">
												<option value="" selected>Status</option>
                        <option>Open</option>
												<option>Closed</option>
										</select>
									</th> -->
                  <th class="wd-10p">Created Date</th>
                  <th class="wd-10p">View</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <!-- table-wrapper -->
      </div>
      <!-- section-wrapper -->
    </div>
  </div>
</div>
<!--End side app-->
@endsection

@section('additional_scripts')
<!-- Data tables js-->
		<script src="{{asset('assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
		<script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
		<script src="../assets/plugins/select2/select2.full.min.js"></script>
		<script src="../assets/js-dark/select2.js"></script>

    <script src="{{ asset('js/open_ticket.js') }}"></script>


@endsection
