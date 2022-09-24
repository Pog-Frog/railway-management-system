<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Egypt Railway</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!--
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE
	DESIGNED & DEVELOPED by FREEHTML5.CO

	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />



	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

	<!-- Animate.css -->
    <link rel="stylesheet" href="{{ URL::asset('css/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href=" {{ URL::asset('css/icomoon.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href=" {{ URL::asset('css/bootstrap.css') }}">
	<!-- Superfish -->
	<link rel="stylesheet" href=" {{ URL::asset('css/superfish.css') }}">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href=" {{ URL::asset('css/magnific-popup.css') }}">
	<!-- Date Picker -->
	<link rel="stylesheet" href=" {{ URL::asset('css/bootstrap-datepicker.min.css') }}">
	<!-- CS Select -->
	<link rel="stylesheet" href=" {{ URL::asset('css/cs-select.css') }}">
	<link rel="stylesheet" href=" {{ URL::asset('css/cs-skin-border.css') }} ">

	<link rel="stylesheet" href=" {{ URL::asset('css/style.css') }}">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>

    <body>
        <div id="fh5co-wrapper">
		<div id="fh5co-page">
        <header id="fh5co-header-section" class="sticky-banner">
			<div class="container">
				<div class="nav-header">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 id="fh5co-logo"><a href="{{route('user_index')}}"><i></i>Egypt Railway</a></h1>

					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active"><a href="{{route('user_index')}}">Home</a></li>



							<li><a href="{{route('today_trips')}}">Today`s Trips</a></li>
                            <li><a href="{{route('user_contact')}}">Contact Us</a></li>


                            @if(session()->has('loginID'))


                            <li>
								<a  class="fh5co-sub-ddown">Manage Your Trips</a>
								<ul class="fh5co-sub-menu">
								<li><a href="{{route('user_book_index')}}">Book A Trip</a></li>
									<li><a href="{{route('user_view_booked_trips')}}">View Booked Trips</a></li>


								</ul>
							</li>
                            <li><a href="{{route('user_logout')}}">Logout</a></li>

                            @else

							<li><a href="{{route('user_login_index')}}">Login</a></li>
							<li><a href="{{route('user_register_index')}}">Register</a></li>
                            @endif
						</ul>
					</nav>
				</div>
			</div>
		</header>
		<!-- end:header-top -->
        <!-- END fh5co-page -->
        <!-- END fh5co-wrapper -->


        <!-- jQuery -->


	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/sticky.js"></script>

	<!-- Stellar -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Superfish -->
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Date Picker -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	<!-- CS Select -->
	<script src="js/classie.js"></script>
	<script src="js/selectFx.js"></script>

	<!-- Main JS -->
	<script src="js/main.js"></script>



    </body>
    </html>
