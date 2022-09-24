
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

		@include('includes.header')

		<!-- end:header-top -->


		<div class="fh5co-hero" style="background-image: url(/pics/user/railway.jpg);">

			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover" data-stellar-background-ratio="0.5" style="background-image: {{ URL::asset('pics/user/railway.jpg') }}">
				<div class="desc">
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-md-5">
							@csrf
		@if(Session::has('message'))
            <div class="alert-success">{{Session::get('success')}}

            </div>
        @else
            <div class="alert-danger">{{Session::get('fail')}}

            </div>
        @endif


								@include('includes.book_form')



							</div>

					</div>
				</div>
			</div>

		</div>
</div>

		<div id="fh5co-tours" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>What Is New?</h3>
						<p> Latest News About Egypt Railway</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href=""><img src="{{ URL::asset('pics/user/news1.jpg') }}" alt="Egypt Railway news" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Adjusting the times of some trains on some lines. As of 5/14/2022</h3>

								<a class="btn btn-primary btn-outline" href="{{route('news_1')}}">View <i class="icon-arrow-right22"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="{{ URL::asset('pics/user/news2.jpeg') }}" alt="Egypt Railway news" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>The Minister of Transport honors the distinguished in the authority</h3>

								<a class="btn btn-primary btn-outline" href="{{route('news_2')}}">View <i class="icon-arrow-right22"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="{{ URL::asset('pics/user/news3.jpg') }}" alt="Egypt Railway news" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Entering the service tower between Biba and Al-Fashn</h3>

								<a class="btn btn-primary btn-outline" href="{{route('news_3')}}">View <i class="icon-arrow-right22"></i></a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>




		<div id="fh5co-destination">
			<div class="tour-fluid">
				<div class="row">
					<div class="col-md-12">
						<ul id="fh5co-destination-list" class="animate-box">
							<li class="one-forth text-center" style="background-image: url(/pics/user/alex.jpg); ">
								<a href="{{route('user_book_index')}}">
									<div class="case-studies-summary">
										<h2>Alexandria</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(/pics/user/aswan.jpg); ">
								<a href="{{route('user_book_index')}}">
									<div class="case-studies-summary">
										<h2>Aswan</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(/pics/user/cairo.jpg); ">
								<a href="{{route('user_book_index')}}">
									<div class="case-studies-summary">
										<h2>Cairo</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(/pics/user/dahab.jpg); ">
								<a href="{{route('user_book_index')}}">
									<div class="case-studies-summary">
										<h2>Dahab</h2>
									</div>
								</a>
							</li>

							<li class="one-forth text-center" style="background-image: url(/pics/user/giza.jpg); ">
								<a href="{{route('user_book_index')}}">
									<div class="case-studies-summary">
										<h2>Giza</h2>
									</div>
								</a>
							</li>
							<li class="one-half text-center">
								<div class="title-bg">
									<div class="case-studies-summary">
										<h2>New To Egypt?</h2>
										<h3>Here Are Some Most Popular Destinations</h3>

									</div>
								</div>
							</li>
							<li class="one-forth text-center" style="background-image: url(/pics/user/hurghada.jpg); ">
								<a href="{{route('user_book_index')}}">
									<div class="case-studies-summary">
										<h2>Hurghada</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(/pics/user/luxor.jpg); ">
								<a href="{{route('user_book_index')}}">
									<div class="case-studies-summary">
										<h2>Luxor</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(/pics/user/sharm.jpg); ">
								<a href="{{route('user_book_index')}}">
									<div class="case-studies-summary">
										<h2>Sharm El-Sheikh</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(/pics/user/matrouh.jfif); ">
								<a href="{{route('user_book_index')}}">
									<div class="case-studies-summary">
										<h2>Marsa Matruh</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(/pics/user/portsaid.jpg); ">
								<a href="{{route('user_book_index')}}">
									<div class="case-studies-summary">
										<h2>Port Said</h2>
									</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>


		@include('includes.footer')



	</div>
	<!-- END fh5co-page -->

	</div>
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

