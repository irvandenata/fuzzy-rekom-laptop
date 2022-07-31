<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Rekomendasi Laptop</title>
	<meta content="" name="description">

	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="{{ asset('landing') }}/img/favicon.png" rel="icon">
	<link href="{{ asset('landing') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link
		href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
		rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="{{ asset('landing') }}/vendor/aos/aos.css" rel="stylesheet">
	<link href="{{ asset('landing') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('landing') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="{{ asset('landing') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="{{ asset('landing') }}/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="{{ asset('landing') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="{{ asset('landing') }}/css/style.css" rel="stylesheet">

	<!-- =======================================================
		* Template Name: FlexStart - v1.10.1
		* Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
		* Author: BootstrapMade.com
		* License: https://bootstrapmade.com/license/
		======================================================== -->
</head>

<body>

	<!-- ======= Header ======= -->
	<header id="header" class="header fixed-top">
		<div class="container-fluid container-xl d-flex align-items-center justify-content-between">

			<a href="index.html" class="logo d-flex align-items-center">
				<img src="{{ asset('landing') }}/img/logo.png" alt="">
				<span>RekomendasiLaptop</span>
			</a>

			<nav id="navbar" class="navbar">
				<ul>
					<li><a class="nav-link scrollto active" href="/">Beranda</a></li>
					<li><a class="getstarted scrollto" href="/form">Temukan</a></li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->

		</div>
	</header><!-- End Header -->

	<!-- ======= Hero Section ======= -->
	<section>
		<div class="container position-relative" style="margin-top: 100px">
			<div class="row justify-align-center">
				@foreach ($product as $item)
					<div class="col-lg-7 col-8 my-2 mx-auto">
						<div class="card p-4" style="width: 100%">
							<div class="row justify-content-center">
								<div class="col-lg-2 col-sm-1">
									<h1>{{ $loop->iteration }}</h1>
								</div>
								<div class="col-lg-3 col-sm-11">
									<img src="/storage/{{ $item->imagePath }}" width="120" alt="">
								</div>
								<div class="col-lg-4 col-sm-12">
									<h4>{{ $item->tipe }} - {{ $item->tahun }} </h4>
									<h6>Ram : {{ $item->ram }} GB ({{ $item->speed_ram }} MHz) </h6>
									<h6>Processor : {{ $item->processor }} ({{ $item->speed_processor }} GHz) </h6>
									<h6>Storage : {{ $item->storage }} (W: {{ $item->speed_write }} , R: {{ $item->speed_read }}) </h6>
									<h5>Harga : Rp.{{ number_format($item->harga, 2) }} </h5>
								</div>
							</div>
						</div>
					</div>
				@endforeach

			</div>

		</div>
	</section><!-- End Hero -->


	<!-- Vendor JS Files -->
	<script src="{{ asset('landing') }}/vendor/purecounter/purecounter_vanilla.js"></script>
	<script src="{{ asset('landing') }}/vendor/aos/aos.js"></script>
	<script src="{{ asset('landing') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('landing') }}/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="{{ asset('landing') }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="{{ asset('landing') }}/vendor/swiper/swiper-bundle.min.js"></script>
	<script src="{{ asset('landing') }}/vendor/php-email-form/validate.js"></script>

	<!-- Template Main JS File -->
	<script src="{{ asset('landing') }}/js/main.js"></script>
</body>

</html>
