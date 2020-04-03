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
  		<li class="breadcrumb-item active" aria-current="page">Employee Details</li>
  	</ol><!-- End breadcrumb -->
  </div>
  <!-- End page-header -->
  <!--row open-->
      <div class="row row-cards">
      <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
        <div class="card">
          <div class="card-body text-center list-icons">
            <i class="si si-briefcase text-primary"></i>
            <p class="card-text mt-3 mb-3">Total Projects</p>
            <p class="h1 text-center  text-primary">459</p>
          </div>
        </div>
      </div><!-- col end -->
      <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
        <div class="card">
          <div class="card-body text-center list-icons">
            <i class="si si-basket-loaded text-secondary"></i>
            <p class="card-text mt-3 mb-3">New Sales</p>
            <p class="h1 text-center  text-secondary">262</p>
          </div>
        </div>
      </div><!-- col end -->
      <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
        <div class="card">
          <div class="card-body text-center list-icons">
            <i class="si si-people text-warning"></i>
            <p class="card-text mt-3 mb-3">Employees</p>
            <p class="h1 text-center  text-warning">789</p>
          </div>
        </div>
      </div><!-- col end -->
      <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
        <div class="card">
          <div class="card-body text-center list-icons">
            <i class="si si-eye text-success"></i>
            <p class="card-text mt-3 mb-3">Customer Visitis</p>
            <p class="h1 text-center text-success">2635</p>
          </div>
        </div>
      </div><!-- col end -->
    </div>
    <!--  Main card profile  -->
    <div class="row">
    	<div class="col-md-12">
        <div class="card card-profile overflow-hidden">
    			<div class="card-body">
            <div class=" card-profile">
              <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-7">
                  <div class="row">
                    <h2 class="text-primary">Employee Profile</h2> <h5 class="text-primary"><sup><i class="fa fa-info-circle"></i></sup></h5>
                  </div>
                   <div class="row">
                     <div class="col-lg-6">
                      <h5>
                          <strong class="text-primary">Department Name:</strong>
                      </h5>
                      <hr class="my-2">
                      <h5>
                        <strong class="text-primary">Name :</strong>
                      </h5>
                      <hr class="my-2">
                     </div>
                     <div class="col-lg-6">
                        <h5>
                          <strong class="text-primary">Email :</strong>
                        </h5>
                        <hr class="my-2">
                        <h5>
                          <strong class="text-primary">Mobile No. :</strong>
                        </h5>
                        <hr class="my-2">
                     </div>
                   </div>
                </div><!--col-md-7 -->
                <div class="col-md-4 justify-content-center">
                  <div class="row justify-content-center">
                    <div class="col-12">
                      <a href="" class="btn btn-pill btn-info btn-sm float-right">
                        <i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit profile
                      </a>
                    </div>
                  </div>
              </div>
            </div>
          </div>
         </div>
        </div>
      </div>
    </div>
  </div>
<!--End side app-->
@endsection

@section('additional_scripts')
<!--Accordion-Wizard-Form js-->
<!-- <script src="../assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script> -->
<script src="{{ asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>
<script src="../assets/plugins/notify/js/notifIt.js"></script>
<script src="../assets/plugins/select2/select2.full.min.js"></script>


@endsection
