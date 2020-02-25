@extends('layouts.app')

@section('additional_headers')
<!-- Data table css -->
		<link href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />

		<link href="{{ asset('assets/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet" />
@endsection


@section('content')

<div class="side-app">

	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Ticket List</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->

  <div class="row">
    <div class="col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">All Tickets</div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="ticket_table" class="table table-striped table-bordered text-nowrap w-100">
              <thead>
                <tr>
                  <th class="wd-20p">#ID</th>
                  <th class="wd-20p"> Ticket Title</th>
                  <th class="wd-15p">Department</th>
                  <th class="wd-15p">Category</th>
                  <th class="wd-10p">Priority</th>
                  <th class="wd-10p">Creator</th>
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

    <script src="{{ asset('js/ticket_list.js') }}"></script>


@endsection
