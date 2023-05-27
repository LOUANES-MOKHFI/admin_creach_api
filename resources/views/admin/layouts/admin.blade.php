<!DOCTYPE html>
<html class="js" lang="fr" data-textdirection="{{app()-> getLocale() === 'ar' ? 'rtl' :'ltr'}}" dir="{{app()-> getLocale() === 'ar' ? 'rtl' :'ltr'}}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">


	<!-- Title -->
	<title> @yield("title") </title>
	<link rel="icon" href="{{asset('admin/assets/img/brand/favicon.png')}}" type="image/x-icon"/>
	<!-- Icons css -->
	<link href="{{asset('admin/assets/css-rtl/icons.css')}}" rel="stylesheet">
	<!--  Custom Scroll bar-->
	<link href="{{asset('admin/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
	<!--  Sidebar css -->
	<link href="{{asset('admin/assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
	<!-- Sidemenu css -->
	<link rel="stylesheet" href="{{asset('admin/assets/css-rtl/sidemenu.css')}}">

	<!--- Style css -->
	<link href="{{asset('admin/assets/css-rtl/style.css')}}" rel="stylesheet">
	<!--- Dark-mode css -->
	<link href="{{asset('admin/assets/css-rtl/style-dark.css')}}" rel="stylesheet">
	<!---Skinmodes css-->
	<link href="{{asset('admin/assets/css-rtl/skin-modes.css')}}" rel="stylesheet">
	<link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
	<!--Internal  Datetimepicker-slider css -->
	<link href="{{asset('admin/assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
	<link href="{{asset('admin/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
	<link href="{{asset('admin/assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
	<!-- Internal Spectrum-colorpicker css -->
	<link href="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">


	<link href="{{ asset('admin/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ asset('admin/assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />


	<style>
		.badge {
			padding: 0.25em 0.4em !important;
			font-size: 75% !important;
		}
	</style>
    @yield('style')


</head>
<body class="main-body app sidebar-mini">
	<!-- Loader -->
	<!-- <div id="global-loader">
		<img src="{{asset('admin/assets/img/loader.svg')}}" class="loader-img" alt="Loader">
	</div> -->
	<!-- /Loader -->
	@include('admin.includes.main-sidebar')		
	<!-- main-content -->
	<div class="main-content app-content">
		@include('admin.includes.main-header')			
		<!-- container -->
		<div class="container-fluid">
			@yield('content')			
        	@include('admin.includes.footer')

		</div>
	</div>
<script src="{{asset('admin/assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="{{asset('admin/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{asset('admin/assets/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{asset('admin/assets/plugins/moment/moment.js')}}"></script>

<!-- Rating js-->
<script src="{{asset('admin/assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{asset('admin/assets/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
<!--Internal Sparkline js -->
<script src="{{asset('admin/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{asset('admin/assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- right-sidebar js -->
<script src="{{asset('admin/assets/plugins/sidebar/sidebar-rtl.js')}}"></script>
<script src="{{asset('admin/assets/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{asset('admin/assets/js/eva-icons.min.js')}}"></script>

<!-- Sticky js -->
<script src="{{asset('admin/assets/js/sticky.js')}}"></script>
<!-- custom js -->
<script src="{{asset('admin/assets/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{asset('admin/assets/plugins/side-menu/sidemenu.js')}}"></script>





	@yield('script')

</body>
</html>
