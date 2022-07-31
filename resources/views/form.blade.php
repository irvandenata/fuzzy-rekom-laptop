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
					<li><a class="getstarted scrollto" href="#about">Temukan</a></li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->

		</div>
	</header><!-- End Header -->

	<!-- ======= Hero Section ======= -->
	<section id="hero" class="hero d-flex align-items-center">

		<div class="container">

			<form action="{{ route('fuzzy') }}" method="post">
				@csrf
				<div class="row">
					<div class="col-lg-8 d-flex flex-column justify-content-center">
						<h1 data-aos="fade-up">Tentukan Kriteria!</h1>
						<div class="row" data-aos="fade-up" data-aos-delay="400">
							<div class="col-6 form-group">
								<label for="">Pilih Tipe</label>
								<select name="tipe" class="form-control" id="" selected>
									<option value disabled selected>-- Pilih Salah Satu ---</option>
									<option value="Macbook Pro">Macbook Pro</option>
									<option value="Macbook Air">Macbook Air</option>
								</select>
							</div>
							<div class="col-6 form-group">
								<label for="">Pilih Tahun</label>
								<select name="tahun" class="form-control" id="" selected>
									<option value disabled selected>-- Pilih Salah Satu ---</option>

									<option value="terbaru">Terbaru</option>
									<option value="lama">Lama</option>
								</select>
							</div>
							<div class="col-6 form-group">
								<label for="">Pilih Kecepatan Processor</label>
								<select name="speed_processor" class="form-control" id="" selected>
									<option value disabled selected>-- Pilih Salah Satu ---</option>

									<option value="cepat">Cepat</option>
									<option value="sedang">Sedang</option>
									<option value="lambat">Lambat</option>
								</select>
							</div>

							<div class="col-6 form-group">
								<label for="">Pilih RAM</label>
								<select name="ram" class="form-control" id="" selected>
									<option value disabled selected>-- Pilih Salah Satu ---</option>
									<option value="besar">Besar</option>
									<option value="kecil">Kecil</option>
								</select>
							</div>
							<div class="col-6 form-group">
								<label for="">Pilih Kecepatan RAM</label>
								<select name="speed_ram" class="form-control" id="" selected>
									<option value disabled selected>-- Pilih Salah Satu ---</option>
									<option value="cepat">Cepat</option>
									<option value="lambat">Lambat</option>
								</select>
							</div>
							<div class="col-6 form-group">
								<label for="">Pilih Storage</label>
								<select name="storage" class="form-control" id="" selected>
									<option value disabled selected>-- Pilih Salah Satu ---</option>
									<option value="besar">Besar</option>
									<option value="sedang">Sedang</option>
									<option value="kecil">Kecil</option>
								</select>
							</div>
							<div class="col-6 form-group">
								<label for="">Pilih Kecepatan Write </label>
								<select name="speed_write" class="form-control" id="" selected>
									<option value disabled selected>-- Pilih Salah Satu ---</option>
									<option value="cepat">Cepat</option>
									<option value="sedang">Sedang</option>
									<option value="lambat">Lambat</option>
								</select>
							</div>
							<div class="col-6 form-group">
								<label for="">Pilih Kecepatan Read</label>
								<select name="speed_read" class="form-control" id="" selected>
									<option value disabled selected>-- Pilih Salah Satu ---</option>
									<option value="cepat">Cepat</option>
									<option value="sedang">Sedang</option>
									<option value="lambat">Lambat</option>
								</select>
							</div>
							<div class="col-12 form-group">
								<label for="">Budget</label>
								<input type="number" min="0" name="harga" class="form-control" required>
							</div>
						</div>
						<div data-aos="fade-up" data-aos-delay="600">
							<div class="text-center text-lg-start">
								<button type="submit"
									class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
									<span>Temukan</span>
									<i class="bi bi-arrow-right"></i>
								</button>
							</div>
						</div>
					</div>
					<div class="col-lg-4 hero-img" data-aos="zoom-out" data-aos-delay="200">
						<img src="{{ asset('landing') }}/img/hero-img.png" class="img-fluid" alt="">
					</div>
				</div>
			</form>

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
