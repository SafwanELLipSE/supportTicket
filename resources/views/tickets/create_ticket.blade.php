@extends('layouts.app')

@section('additional_headers')

<!-- WYSIWYG Editor css -->
<link href="../assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />
<!-- side app-->

@endsection

@section('content')

<div class="side-app">
	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="{{route('deshboard.home')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Create Ticket</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->
  <div class="row">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
			<form action="{{ route('ticket.save_created') }}" method="POST" enctype="multipart/form-data">
				@csrf
	      <div class="card">
	        <div class="card-header">
	            <h3 class="card-title">Create Ticket</h3>
	        </div>
	        <div class="card-body">
						<div class="form-group">
	            <label class="form-label">Title</label>
	            <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Ticket title" value="{{ old('title') }}" required>
	          </div>
						<div class="form-group">
	            <div class="row">
	              <div class="col-lg-6 col-md-12">
									<label class="form-label">Departments</label>
	                <select class="form-control" id="department" name="department" value="{{ old('department') }}" required>
										@foreach($departments as $department )
											<option data-department="{{$department->id}}" value="{{$department->id}}">{{$department->name}}</option>
										@endforeach
	                </select>
	              </div>
								<div class="col-lg-6 col-md-12" >
									<label class="form-label">Category</label>
	                <select class="form-control" id="category" name="category" value="{{ old('category') }}" required>
										@foreach($departments as $department )
												@foreach($department->ticketCategories as $item )
														<option data-department="{{$item->department_id}}" value="{{$item->id}}">{{$item->category}}</option>
												@endforeach
										@endforeach
										<option data-department="0" value="0">Others</option>
	                </select>
	              </div>
	            </div>
	          </div>
	          <div class="row">
	            <div class="col-lg-4 col-md-12">
	              <div class="form-group">
	                <label class="form-label">Customer Name</label>
	                <input type="text" class="form-control" id="exampleInputname" placeholder="Customer Name"  value="{{ old('customer_name') }}" name="customer_name">
	              </div>
	            </div>
							<div class="col-lg-4 col-md-12">
								<div class="form-group">
			            <label class="form-label">Contact Number</label>
			            <input type="number" class="form-control" id="exampleInputnumber" placeholder="ph number" value="{{ old('phone') }}" name="phone">
			          </div>
	            </div>
							<div class="col-lg-4 col-md-12">
								<label class="form-label">Priority</label>
								<select class="form-control" name="priority" required>
									<option value="0">Minor</option>
									<option value="1">Major</option>
									<option value="2">Critical</option>
								</select>
							</div>
	          </div>
						<div class="form-group">
							<label class="form-label">Description</label>
							<textarea class="content" name="description" required>{{ old('description') }}</textarea>
						</div>
						<div class="row">
	            <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
								<div class="form-group">
									<label class="form-label">Upload Files</label>
									<div class="custom-file row ml-1">
										<input type="file" class="custom-file-input" name="filesToUpload[]" id="filesToUpload"  multiple="multiple" />
										<label class="custom-file-label">Choose files</label>
									</div>
								</div>
	            </div>
							<div class="col-lg-6 col-md-12 col-sm-12 col-sm-12 col-xm-12">
								<div class="form-group">
			            <label class="form-label">Upload Images</label>
									<div class="custom-file row ml-1">
	      						<input type="file" class="custom-file-input" name="imagesToUpload[]" id="filesToUpload"  multiple="multiple" />
										<label class="custom-file-label">Choose Images</label>
	    						</div>
			          </div>
	            </div>
	          </div>
	        </div>
	        <div class="card-footer text-right">
	          <button type="submit" class="btn btn-success mt-1">Save</button>
					</div>
	          <!-- <a href="#" class="btn btn-warning mt-1">Cancel</a> -->
	     	</div>
	    </div>
		</form>
   </div>
</div>
<!--End side app-->
@endsection

@section('additional_scripts')
<!-- WYSIWYG Editor js -->
<script src="../assets/plugins/wysiwyag/jquery.richtext.js"></script>
<script src="../assets/plugins/wysiwyag/richText1.js"></script>
<script src="{{ asset('js/create_ticket.js') }}"></script>
@endsection
