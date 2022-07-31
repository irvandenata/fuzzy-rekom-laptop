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
					<li><a class="getstarted scrollto" href="{{ route('form') }}">Temukan</a></li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->

		</div>
	</header><!-- End Header -->

	<!-- ======= Hero Section ======= -->
	<section id="hero" class="hero d-flex align-items-center">

		<div class="container">
			<div class="row">
				<div class="col-lg-6 d-flex flex-column justify-content-center">
					<h1 data-aos="fade-up">Solusi tepat menemukan laptop impian !</h1>
					<h2 data-aos="fade-up" data-aos-delay="400">Temukan laptop impian anda tanpa harus belajar lebih jauh tentang
						laptop</h2>
					<div data-aos="fade-up" data-aos-delay="600">
						<div class="text-center text-lg-start">
							<a href="{{ route('form') }}"
								class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
								<span>Temukan</span>
								<i class="bi bi-arrow-right"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
					<img src="{{ asset('landing') }}/img/hero-img.png" class="img-fluid" alt="">
				</div>
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
