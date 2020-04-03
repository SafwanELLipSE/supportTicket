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
			<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Department List</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->

  <div class="row">
    <div class="col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">All Departments ({{ count($departments) }})</div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="department_table" class="table table-striped table-bordered text-nowrap w-100">
              <thead>
                <tr>
                  <th class="wd-20p">#ID</th>
                  <th class="wd-20p">Department</th>
                  <th class="wd-15p">Name</th>
                  <th class="wd-10p">Email</th>
									<th class="wd-10p">Mobile Number</th>
                  <th class="wd-10p">Ticket Category</th>
                  <th class="wd-10p">Created Date</th>
                  <th class="wd-10p">View</th>
                </tr>
              </thead>
              <tbody>
                @foreach($departments as $item)
									<tr role="row" class="odd">
                    <td>{{$item->id}}</td>
										<td>{{$item->name}}</td>
										<td>{{$item->user->name}}</td>
										<td>{{$item->user->email}}</td>
										<td>{{$item->user->mobile_no}}</td>
										<td>
											<select size="1" class="form-control wd-20p">
                        @foreach($item->ticketCategories as $ticket_cat)
                        	<option value="{{$ticket_cat->id}}">{{$ticket_cat->category}}</option>
                        @endforeach
											</select>
										</td>
										<td>{{$item->created_at->format('d.m.Y')}}</td>
										<td><a href="{{ route('department.details',$item->id) }}" class="btn btn-sm btn-primary">view</a></td>
									</tr>
                  @endforeach
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

    <script src="{{ asset('js/department_list.js') }}"></script>
@endsection
