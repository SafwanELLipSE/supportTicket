<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="Hogo– Creative Admin Multipurpose Responsive Bootstrap4 Dashboard HTML Template" name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="html admin template, bootstrap admin template premium, premium responsive admin template, admin dashboard template bootstrap, bootstrap simple admin template premium, web admin template, bootstrap admin template, premium admin template html5, best bootstrap admin template, premium admin panel template, admin template"/>

		<!-- Favicon -->

    <link rel="icon" href="{{asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/favicon.ico')}}"/>


		<!-- Title -->
		<title>Support Ticket Reset Password</title>

		<!--Bootstrap.min css-->
		<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">


		<!-- Dashboard css -->
		<link href="{{asset('assets/css-dark/style.css')}}" rel="stylesheet" />

		<!---Font icons css-->
		<link href="{{asset('assets/plugins/iconfonts/plugin.css')}}" rel="stylesheet" />

		<link href="{{asset('assets/plugins/iconfonts/icons.css')}}" rel="stylesheet" />

		<link  href="{{asset('assets/fonts/fonts/font-awesome.min.css')}}" rel="stylesheet">


	</head>
	<body class="bg-account">
	    <!-- page -->
		<div class="page">

			<!-- page-content -->
			<div class="page-content">
				<div class="container text-center text-dark">
					<div class="row">
						<div class="col-lg-4 d-block mx-auto">
							<div class="row">
								<div class="col-xl-12 col-md-12 col-md-12">
									<div class="card">
									 <div class="card-body">
										<div class="text-center mb-6">
											<img src="{{ asset('assets/images/brand/service_chai.png') }}" class="" alt="">
											<!-- <h3>Support Ticket</h3> -->
										</div>
										<h3>Reset Password</h3>
								<form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

										<div class="input-group  mr-auto ml-auto mb-4">
											<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
											<input type="email" id="email" name="email" class="form-control" placeholder="Email address">
										</div>
                    <div class="input-group mb-4">
                      <span class="input-group-addon "><i class="fa fa-unlock-alt"></i></span>
                      <input id="password" type="password" class="form-control" name="password" placeholder="New Password">
                    </div>
                    <div class="input-group mb-4">
                      <span class="input-group-addon "><i class="fa fa-unlock-alt"></i></span>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                    </div>
										<div class="text-center">
											<button type="submit" class="btn btn-primary btn-block">{{ __('Reset Password') }}</button>
										</div>
								 </form>
									</div>
								</div>
							 </div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- page-content end -->
		</div>
		<!-- page End-->

		<!-- Jquery js-->
    <script src="{{asset('assets/js-dark/vendors/jquery-3.2.1.min.js')}}"></script>
		<!--Bootstrap.min js-->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
		<!-- Custom js-->
    <script src="{{asset('assets/js-dark/custom.js')}}"></script>

	</body>
</html>
