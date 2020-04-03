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
			<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Create Employees</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->
  <!--row open-->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Add New Employee</h3>
									</div>
									<div class="card-body">
										<form action="{{ route('employee.save_created') }}" method="POST" id="form" >
												@csrf
											<div class="list-group">
												<div class="list-group-item py-3" data-acc-step>
													<h5 class="mb-0" data-acc-title>Choose Department</h5>
													<div data-acc-content>
														<div class="my-3">
                              <div class="form-group">
                                <label>Department Name:</label>
                                  <select id="department" name="department" class="form-control department">
                                    <option value="0"></option>
                                    @foreach($departments as $department )
                                      <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
														</div>
													</div>
												</div>
												<div class="list-group-item py-3" data-acc-step>
													<h5 class="mb-0" data-acc-title>Employee Credentials</h5>
													<div data-acc-content>
														<div class="my-3">
                              <div class="form-group">
                                <label>Employee Name:</label>
                                <input type="text" name="name" class="form-control name" />
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Email:</label>
                                    <input type="text" name="email" class="form-control email" />
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Mobile:</label>
                                    <input type="text" name="mobile_no" class="form-control mobile" />
                                  </div>
                                </div>
                              </div>
														</div>
													</div>
												</div>
                        <div class="list-group-item py-3" data-acc-step>
													<h5 class="mb-0" data-acc-title>Ticket Category Assign</h5>
													<div data-acc-content>
														<div class="my-3">

															<!--     Not Used Yet      -->
                              <div class="custom-controls-stacked">
        												<label class="custom-control custom-checkbox">
        													<input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked>
        													<span class="custom-control-label">Email</span>
        												</label>
                                <label class="custom-control custom-checkbox">
        													<input type="checkbox" class="custom-control-input" name="example-checkbox2" value="option2" checked>
        													<span class="custom-control-label">Message</span>
        												</label>
											         </div>

														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->
</div>
<!--End side app-->
@endsection

@section('additional_scripts')
<script>

</script>

<!--Accordion-Wizard-Form js-->
<!-- <script src="../assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script> -->
<script src="{{ asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>
<script src="../assets/plugins/notify/js/notifIt.js"></script>
<script src="../assets/plugins/select2/select2.full.min.js"></script>
<script src="{{ asset('js/create_employee.js') }}"></script>
<script>
$('.select2').select2({
  minimumResultsForSearch: Infinity
});
</script>

@endsection
