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
		<title>Support Ticket Login</title>

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
											<form method="POST" action="{{ route('login') }}">
	                        @csrf
													<div class="text-center mb-6">
														<!-- <img src="{{asset('assets/images/brand/logo1.png')}}" class="" alt=""> -->
		                        <h3>Support Ticket</h3>

													</div>
													<h3>Login</h3>
													<p class="text-muted">Sign In to your account</p>
													<div class="input-group mb-3">
														<span class="input-group-addon"><i class="fa fa-user"></i></span>
														<input type="email" class="form-control" name="email" placeholder="Email">
													</div>

													<div class="input-group mb-4">
														<span class="input-group-addon "><i class="fa fa-unlock-alt"></i></span>
														<!-- <input type="password" class="form-control" placeholder="Password"> -->
		                        <input id="password" type="password" class="form-control" name="password">
													</div>

													<div class="row">
														<div class="col-12">
															<button type="submit" class="btn btn-primary btn-block">Login</button>
														</div>
														<div class="col-12">
															<a href="{{ route('password.request') }}" class="btn btn-link box-shadow-0 px-0">Forgot password?</a>
														</div>
													</div>
													<!-- <div class="mt-6 btn-list">
														<button type="button" class="btn btn-icon btn-facebook"><i class="fa fa-facebook"></i></button>
														<button type="button" class="btn btn-icon btn-google"><i class="fa fa-google"></i></button>
														<button type="button" class="btn btn-icon btn-twitter"><i class="fa fa-twitter"></i></button>
														<button type="button" class="btn btn-icon btn-dribbble"><i class="fa fa-dribbble"></i></button>
													</div> -->
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
