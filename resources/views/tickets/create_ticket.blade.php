@extends('layouts.app')

@section('content')

@section('additional_headers')

<!-- WYSIWYG Editor css -->
<link href="../assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />
<!-- side app-->

@endsection


<div class="side-app">

	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Create Ticket</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->

  <div class="row">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Ticket</h3>
        </div>
        <div class="card-body">
					<div class="form-group">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ticket title">
          </div>
					<div class="form-group">

            <div class="row">
              <div class="col-lg-6 col-md-12">
								<label class="form-label">Departments</label>
                <select class="form-control">
                  <option value="0">Jhorotek</option>
                  <option value="1">Joycalls</option>
                  <option value="2">shuru Campus</option>
                  <option value="3">Banglavision</option>
                </select>
              </div>
							<div class="col-lg-6 col-md-12" >
								<label class="form-label">Category</label>
                <select class="form-control">
                  <option value="0">Website</option>
                  <option value="1">Servicing</option>
                  <option value="2">Motors</option>
                  <option value="3">others</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-12">
              <div class="form-group">
                <label class="form-label">Issuer Name</label>
                <input type="text" class="form-control" id="exampleInputname" placeholder="First Name">
              </div>
            </div>
						<div class="col-lg-4 col-md-12">
							<div class="form-group">
		            <label class="form-label">Conatct Number</label>
		            <input type="number" class="form-control" id="exampleInputnumber" placeholder="ph number">
		          </div>
            </div>
						<div class="col-lg-4 col-md-12">
							<label class="form-label">Priority</label>
							<select class="form-control">
								<option value="0">Major</option>
								<option value="1">Minor</option>
								<option value="2">Critical</option>
							</select>
						</div>
          </div>
					<div class="form-group">
						<label class="form-label">Description</label>
						<textarea class="content" name="example"></textarea>
					</div>
					<div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
							<div class="form-group">
								<label class="form-label">Upload Files</label>
								<div class="row">
									<input type="file" name="filesToUpload[]" id="filesToUpload" multiple="multiple" />
								</div>
							</div>
            </div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-sm-12 col-xm-12">
							<div class="form-group">
		            <label class="form-label">Upload Images</label>
								<div class="row">
      						<input type="file" name="imagesToUpload[]" id="filesToUpload" multiple="multiple" />
    						</div>
		          </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-right">
          <a href="#" class="btn btn-success mt-1">Save</a>
          <a href="#" class="btn btn-warning mt-1">Cancel</a>
        </div>
      </div>
    </div>
  </div>

</div>
<!--End side app-->
@endsection

@section('additional_scripts')
<!-- WYSIWYG Editor js -->
<script src="../assets/plugins/wysiwyag/jquery.richtext.js"></script>
<script src="../assets/plugins/wysiwyag/richText1.js"></script>
@endsection
