@extends('layouts.app')

@section('additional_headers')

@endsection

@section('content')

<div class="side-app">
	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">My Agents</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->
  <div class="row">
  	<div class="col-md-12">
  			<!-- begin profile-content -->
  			<div class="profile-content">
          <!-- begin #profile-friends tab -->
          <div class="tab-pane fade in active show" id="profile-friends">
            <h4 class="mt-0 mb-4">Agents ({{ count($agents) }})</h4><!-- begin row -->
            <div class="row row-space-2">
              @foreach($agents as $item)
              <!-- end col-6 -->
              <div class="col-xl-6">
                <div class="mb-2 border shadow">
                  <div class="media overflow-visible">
                    <a class="media-left" href="javascript:;"><img alt="" class="avatar avatar-md brround" src="../assets/images/users/female/2.jpg"></a>
                    <div class="media-body valign-middle">
                      <b class="text-inverse">{{$item->name}}</b> <br> <sub class="text-info">{{$item->mobile_no}}</sub>
                    </div>
                    <div class="media-body valign-middle text-right overflow-visible">
                      <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Active
                      </button>
                      <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li><a href="#">View profile</a></li>
                        <li><a href="#">Message</a></li>
                        <li><a href="#">Inactive</a></li>
                      </ul>
                    </div>
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
