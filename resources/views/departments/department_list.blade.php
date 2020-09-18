@extends('layouts.app')

@section('additional_headers')
<!-- Data table css -->
		<link href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
		<link href="{{asset('assets/plugins/select2/select2.min-dark.css')}}" rel="stylesheet" />
		<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

		<link href="{{ asset('assets/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<style media="screen">
			.button-style{
				background-color:#fff;
				border-radius: 50%;
				border:2px solid #FFF;
			}
</style>

@endsection


@section('content')

<div class="side-app">

	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="{{route('deshboard.home')}}">Home</a></li>
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
                  <th class="wd-20p">Ticket Category</th>
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
											<div class="row">
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 my-2">
													<a href="#" data-toggle="modal" data-departmentid="{{$item->id}}" data-target="#categoryModal"><i class="fa fa-plus-circle button-style"></i></a>
												</div>
												<div class="col-xl-10 col-lg-10 cal-md-10 col-sm-10">
													<select size="1" class="form-control wd-20p">
														@foreach($item->ticketCategories as $ticket_cat)
															<option value="{{$ticket_cat->id}}">{{$ticket_cat->category}}</option>
														@endforeach
													</select>
												</div>
											</div>
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
<!-- Data tables js-->
		<script src="{{asset('assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
		<script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
		<script src="../assets/plugins/select2/select2.full.min.js"></script>
		<script src="../assets/js-dark/select2.js"></script>
		<script src="{{ asset('js/department_list.js') }}"></script>

@endsection
