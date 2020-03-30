<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>MRBS</title>
	<!-- Favicons (created with http://realfavicongenerator.net/)-->
	<link rel="icon" type="image/png" href="{{ asset('assets_front/icons/icon2.png') }}" sizes="32x32">
	<link rel="icon" type="image/png" href="{{ asset('assets_front/icons/icon2.png') }}" sizes="16x16">
	<link rel="manifest" href="{{ asset('assets_front/img/favicons/manifest.json') }}">
	<link rel="shortcut icon" href="{{ asset('assets_front/icons/icon2.png') }}">
	<meta name="msapplication-TileColor" content="#00a8ff">
	<meta name="theme-color" content="#ffffff">
	<!-- Normalize -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets_front/css/normalize.css') }}">
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets_front/css/bootstrap.css') }}">
	<!-- Owl -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets_front/css/owl.css') }}">
	<!-- Animate.css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets_front/css/animate.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets_front/fonts/font-awesome-4.1.0/css/font-awesome.min.css') }}">
	<!-- Elegant Icons -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets_front/fonts/eleganticons/et-icons.css') }}">
	<!-- Main style -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets_front/css/cardio.css') }}">
	<!-- Toaster -->
	<link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" />
</head>

<body>
	<div class="preloader">
		<img src="{{asset('assets_front/img/loader.gif')}}" alt="Preloader image">
	</div>
	<nav class="navbar">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/')}}" style="font-family: cursive;">MRBS</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right main-nav">
					<li><a href="{{ url('/')}}">Home</a></li>
					<li><a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-blue">Login</a></li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	<header id="intro">
		<div class="container">
			<div class="table">
				<div class="header-text">
					<div class="row">
						<div class="col-md-12 text-center">
							<h1 class="white typed" style="color:#31b9ff;">Meeting Room Booking System.</h1>
							<span class="typed-cursor">|</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<section>
		<div class="cut cut-top"></div>
		<div class="container">
			<div class="row intro-tables">
				<div class="col-md-6">
					<div class="intro-table intro-table-first">
						<h5 class="white heading">Today's Schedule</h5>
						<div class="owl-carousel owl-schedule bottom">
							<div class="item">
								<div class="schedule-row row">
									<div class="col-xs-6">
										<h5 class="regular white">Early Exercise</h5>
									</div>
									<div class="col-xs-6 text-right">
										<h5 class="white">8:30 - 10:00</h5>
									</div>
								</div>
								<div class="schedule-row row">
									<div class="col-xs-6">
										<h5 class="regular white">Muscle Building</h5>
									</div>
									<div class="col-xs-6 text-right">
										<h5 class="white">8:30 - 10:00</h5>
									</div>
								</div>
								<div class="schedule-row row">
									<div class="col-xs-6">
										<h5 class="regular white">Cardio</h5>
									</div>
									<div class="col-xs-6 text-right">
										<h5 class="white">8:30 - 10:00</h5>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="schedule-row row">
									<div class="col-xs-6">
										<h5 class="regular white">Early Exercise</h5>
									</div>
									<div class="col-xs-6 text-right">
										<h5 class="white">8:30 - 10:00</h5>
									</div>
								</div>
								<div class="schedule-row row">
									<div class="col-xs-6">
										<h5 class="regular white">Muscle Building</h5>
									</div>
									<div class="col-xs-6 text-right">
										<h5 class="white">8:30 - 10:00</h5>
									</div>
								</div>
								<div class="schedule-row row">
									<div class="col-xs-6">
										<h5 class="regular white">Cardio</h5>
									</div>
									<div class="col-xs-6 text-right">
										<h5 class="white">8:30 - 10:00</h5>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="schedule-row row">
									<div class="col-xs-6">
										<h5 class="regular white">Early Exercise</h5>
									</div>
									<div class="col-xs-6 text-right">
										<h5 class="white">8:30 - 10:00</h5>
									</div>
								</div>
								<div class="schedule-row row">
									<div class="col-xs-6">
										<h5 class="regular white">Muscle Building</h5>
									</div>
									<div class="col-xs-6 text-right">
										<h5 class="white">8:30 - 10:00</h5>
									</div>
								</div>
								<div class="schedule-row row">
									<div class="col-xs-6">
										<h5 class="regular white">Cardio</h5>
									</div>
									<div class="col-xs-6 text-right">
										<h5 class="white">8:30 - 10:00</h5>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="intro-table intro-table-third">
						<h5 class="white heading">Happy Clients</h5>
						<div class="owl-testimonials bottom">
							<div class="item">
								<h4 class="white heading content">I couldn't be more happy with the results!</h4>
								<h5 class="white heading light author">Adam Jordan</h5>
							</div>
							<div class="item">
								<h4 class="white heading content">I can't believe how much better I feel!</h4>
								<h5 class="white heading light author">Greg Pardon</h5>
							</div>
							<div class="item">
								<h4 class="white heading content">Incredible transformation and I feel so healthy!</h4>
								<h5 class="white heading light author">Christina Goldman</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content modal-popup">
				<a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
				<h3 class="white">Login</h3>
				<form role="form" class="popup-form" id="form-login">
					{{ csrf_field() }}
					<input type="text" name="username"  class="form-control form-white" placeholder="Employee ID">
					<input type="password" name="password" class="form-control form-white" placeholder="Password">
					<button type="submit" class="btn btn-submit login-btn">Login</button>
				</form>
			</div>
		</div>
	</div>
	<footer>
		<div class="container">
			<div class="row">

			</div>
			<div class="row bottom-footer text-center-mobile">
				<div class="col-sm-8">
					<p style="color:white;">&copy; <script>
						document.write(new Date().getFullYear())
					</script>, All Rights Reserved. Powered by <a href="#">IT Team</a> exclusively for <a href="#">IBIDEN</a></p>
				</div>
				<div class="col-sm-4 text-right text-center-mobile">
				</div>
			</div>
		</div>
	</footer>
	<!-- Holder for mobile navigation -->
	<div class="mobile-nav">
		<ul>
		</ul>
		<a href="#" class="close-link"><i class="arrow_up"></i></a>
	</div>
	<!-- Scripts -->
	<script src="{{ asset('assets_front/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ asset('assets_front/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('assets_front/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets_front/js/wow.min.js') }}"></script>
	<script src="{{ asset('assets_front/js/typewriter.js') }}"></script>
	<script src="{{ asset('assets_front/js/jquery.onepagenav.js') }}"></script>
	<script src="{{ asset('assets_front/js/main.js') }}"></script>
	<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('.login-btn').click(function(event) {
			event.preventDefault();
			var data = $('#form-login').serialize();
			$.ajax({
				type: 'POST',
				url:"{{route('validate')}}",
				data:data,
				dataType:'json',
				success:function(response) {

					if(response.error){
						$.each(response.message, function(index,value){
							toastr.error(value, 'Login');
						});
						console.log(response.password);
					}
					else{
						toastr.success(response.message, 'Login');
						setTimeout(function(){window.location.href="{{route('home')}}"} , 1500);
					}

				}
			});
		});
	</script>
</body>

</html>
