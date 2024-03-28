<?php
include "../admin/koneksi.php";

session_start();
if ($_SESSION['status'] != "valid") {
	header("location: index.php");
}

$nip = $_SESSION['sess_nip'];
$sql = mysqli_query($conn, "SELECT * from tb_pegawai where id_pegawai = $nip");
$sql_row = mysqli_num_rows($sql);

$fetch_pegawai = mysqli_fetch_array($sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="MAVIA - Register, Reservation, Questionare, Reviews form wizard">
	<meta name="author" content="Ansonika">
	<title>Sistem Informasi Surat</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/menu.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/icon_fonts/css/all_icons_min.css" rel="stylesheet">
	<link href="css/skins/square/grey.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">

	<script src="js/modernizr.js"></script>
	<!-- Modernizr -->

</head>

<body>

	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->

	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->

	<header>
		<div class="container-fluid">
			<div class="row">
				<div class="col-3">
					<div id="logo_home">
						<h1><a href="index.html">Sistem Informasi Surat</a></h1>
					</div>
				</div>
				<div class="col-9">
					<nav>
						<ul class="cd-primary-nav">
							<li><a href="index.html" class="animated_link">Surat Ijin</a></li>
							<li><a href="reservation_version.html" class="animated_link">Surat Keterangan Lupa Absen</a></li>
							<li><a href="index.html" class="animated_link">Surat Tugas</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<!-- container -->
	</header>
	<!-- End Header -->

	<main>
		<div id="form_container">
			<div class="row">
				<div class="col-lg-5">
					<div id="left_form">
						<figure><img src="img/registration_bg.svg" alt=""></figure>
						<h2>Surat Ijin</h2>
						<div class="card" style="width: 100%; background: transparent;">
							<table class="table" style="border: none; border-color: #FF6600; color: #fff;">
								<tr>
									<td>Nama </td>
									<td><?php echo $fetch_pegawai['nama_pegawai'] ?></td>
								</tr>
								<tr>
									<td>NIP </td>
									<td><?php echo $fetch_pegawai['nip'] ?></td>
								</tr>
								<tr>
									<td>Pangkat / Gol </td>
									<td>
										<?php
										$pangkat_gol =  $fetch_pegawai['id_pangkat_gol'];
										$sql_pangkat = mysqli_query($conn, "SELECT * from tb_pangkat_golongan where id_pangkat_golongan = $pangkat_gol");
										$fetch_pangkat = mysqli_fetch_array($sql_pangkat);
										echo $fetch_pangkat['pangkat'];
										?> / <?php echo $fetch_pangkat['golongan']; ?>-<?php echo $fetch_pangkat['ruang']; ?></td>
								</tr>
								<tr>
									<td>jabatan </td>
									<td><?php
										$jabatan =  $fetch_pegawai['id_jabatan'];
										$sql_jabatan = mysqli_query($conn, "SELECT * from tb_jabatan where id_jabatan = $jabatan");
										$fetch_jabatan = mysqli_fetch_array($sql_jabatan);
										echo $fetch_jabatan['jabatan_nama']; ?>
									</td>
								</tr>
							</table>
						</div>
						<a href="#0" id="more_info" data-bs-toggle="modal" data-bs-target="#more-info"><i class="pe-7s-info"></i></a>
					</div>
				</div>
				<div class="col-lg-7">

					<div id="wizard_container">
						<div id="top-wizard">
							<div id="progressbar"></div>
						</div>
						<!-- /top-wizard -->
						<form method="POST" action="proses_surat_ijin.php">
							<input id="website" name="website" type="text" value="">
							<div id="middle-wizard">

								<div class="step">
									<div class="row">
										<div class="col-md-12">

										</div>
										<h3 class="main_question mt-3" style="font-size: 16px;"><strong></strong>Please fill with your details</h3>
										<div class="col-md-12">
											<div class="form-group">
												<input type="hidden" name="nip" class="form-control required" value="<?php echo $fetch_pegawai['id_pegawai'] ?>">
												<input type="text" name="no_telp" class="form-control required" placeholder="No Telp">
											</div>
											<div class="form-group">
												<Textarea class="form-control" name="alamat" placeholder="Alamat"></Textarea>
											</div>
											<div class="form-group">
												<Textarea class="form-control" name="alasan" placeholder="Alasan Ijin"></Textarea>
											</div>
											<div class="form-group">
												<label for="">Tanggal Ijin</label>
												<input type="date" name="tanggal_ijin" id="" class="form-control">
											</div>
											<div class="form-group">
												<input type="submit" value="Cetak Surat" name="cetakSuratIjin" class="btn btn-primary">
											</div>
										</div>
									</div>
								</div>
								<!-- /step-->
								<!-- /step-->
							</div>
							<!-- /middle-wizard -->
							<!-- /bottom-wizard -->
						</form>
					</div>
					<!-- /Wizard container -->
				</div>
			</div><!-- /Row -->
		</div><!-- /Form_container -->
	</main>

	<div class="cd-overlay-nav">
		<span></span>
	</div>
	<!-- cd-overlay-nav -->

	<div class="cd-overlay-content">
		<span></span>
	</div>
	<!-- cd-overlay-content -->

	<a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a>
	<!-- SCRIPTS -->
	<!-- Jquery-->
	<script src="js/jquery-3.7.1.min.js"></script>
	<!-- Common script -->
	<script src="js/common_scripts_min.js"></script>
	<!-- Wizard script -->
	<script src="js/registration_wizard_func.js"></script>
	<!-- Menu script -->
	<script src="js/velocity.min.js"></script>
	<script src="js/main.js"></script>
	<!-- Theme script -->
	<script src="js/functions.js"></script>

</body>

</html>