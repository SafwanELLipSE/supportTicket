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
		<link rel="icon"  href="{{ asset('assets/images/brand/service_chai.png') }}" type="image/x-icon">
		<!-- <link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico" /> -->

		<!-- Title -->
		<title>Support Ticket</title>

		<!--Bootstrap.min css-->
		<link  href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

		<!-- Dashboard css -->
		<link  href="{{ asset('assets/css-dark/style.css') }}" rel="stylesheet">

		<!-- Custom scroll bar css-->
		<link  href="{{ asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css') }}" rel="stylesheet">

		<!-- Sidemenu css -->
		<link  href="{{ asset('assets/plugins/toggle-sidebar/dark-full-sidemenu.css') }}" rel="stylesheet">

		<!--Daterangepicker css-->
		<link  href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

		<!-- Rightsidebar css -->
		<link  href="{{ asset('assets/plugins/sidebar/dark-sidebar.css') }}" rel="stylesheet">

		<!-- Sidebar Accordions css -->
		<link  href="{{ asset('assets/plugins/accordion1/css/dark-easy-responsive-tabs.css') }}" rel="stylesheet">

		<!-- Owl Theme css-->

		<link  href="{{ asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">

		<!-- Morris  Charts css-->
		<link  href="{{ asset('assets/plugins/morris/morris.css') }}" rel="stylesheet">

		<!---Font icons css-->
		<link  href="{{ asset('assets/plugins/iconfonts/plugin.css') }}" rel="stylesheet">
		<link  href="{{ asset('assets/plugins/iconfonts/icons.css') }}" rel="stylesheet">
		<link  href="{{ asset('assets/fonts/fonts/font-awesome.min.css') }}" rel="stylesheet">
		<meta name="_token" content="{{ csrf_token() }}">
		@yield('additional_headers')

	</head>

	<body class="app sidebar-mini rtl">

		<!--Global-Loader-->
		<div id="global-loader">
			<img src="../assets/images/icons/loader.svg" alt="loader">
		</div>

		<div class="page">
			<div class="page-main">

				<!--app-header-->
        @include('layouts.nav')
				<!--app-header end-->

				<!-- Sidebar menu-->
        @include('layouts.sidebar')
				<!--sidemenu end-->

        <!-- app-content-->
				<div class="app-content  my-3 my-md-5">
				<!--side app-->
        @yield('content')

				<!--End side app-->

					<!--footer-->
          @include('layouts.footer')
					<!-- End Footer-->

				</div>
				<!-- End app-content-->
			</div>
		</div>
		<!-- End Page -->

		<!-- Back to top -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

		<!-- Jquery js-->
		<script src="{{ asset('assets/js-dark/vendors/jquery-3.2.1.min.js') }}"></script>

		<!--Bootstrap.min js-->
		<script src="{{ asset('assets/plugins/bootstrap/popper.min.js') }}"></script>

		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!--Jquery Sparkline js-->
		<script src="{{ asset('assets/js-dark/vendors/jquery.sparkline.min.js') }}"></script>

		<!-- Chart Circle js-->
		<script src="{{ asset('assets/js-dark/vendors/circle-progress.min.js') }}"></script>

		<!-- Star Rating js-->
		<script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>

		<!--Moment js-->

		<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>

		<!-- Daterangepicker js-->
		<script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

		<!--Side-menu js-->
		<script src="{{ asset('assets/plugins/toggle-sidebar/sidemenu.js') }}"></script>

		<!-- Sidebar Accordions js -->
		<script src="{{ asset('assets/plugins/accordion1/js/easyResponsiveTabs.js') }}"></script>

		<!-- Custom scroll bar js-->
		<script src="{{ asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.jss') }}"></script>

		<!--Owl Carousel js -->
		<script src="{{ asset('assets/plugins/owl-carousel/owl.carousel.js') }}"></script>

		<script src="{{ asset('assets/plugins/owl-carousel/owl-main.js') }}"></script>

		<!-- Rightsidebar js -->
		<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>

		<!-- Charts js-->
		<!-- <script src="../assets/plugins/chart/chart.bundle-dark.js"></script>
		<script src="../assets/plugins/chart/utils.js"></script> -->

		<!--Time Counter js-->
		<script src="{{ asset('assets/plugins/counters/jquery.missofis-countdown.js') }}"></script>
		<script src="{{ asset('assets/plugins/counters/counter.js') }}"></script>

		<!--Morris  Charts js-->
		<!-- <script src="../assets/plugins/morris/raphael-min.js"></script>
		<script src="../assets/plugins/morris/morris.js"></script> -->

		<!-- Custom-charts js-->
		<!-- <script src="../assets/js-dark/index1.js"></script> -->

		<!-- Custom js-->
		<script src="{{ asset('assets/js-dark/custom.js') }}"></script>
		@include('sweetalert::alert')
		@yield('additional_scripts')
	</body>
</html>
