<?php
include "admin/koneksi.php";
session_start();

$nip = $_SESSION['sess_nip'];

if ($_SESSION['status'] != "valid") {
    header("location: index.php");
}

include "admin/koneksi.php";
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = mysqli_query($conn, "SELECT * FROM tb_admin where username = '$username' && password = '$password'");
    $sql_num = mysqli_num_rows($sql);

    if ($sql_num >= 1) {
        session_start();
        $_SESSION['status'] = "Valid";
        $_SESSION['level'] = "Admin";
        $_SESSION['username'] = $username;
        header("location: admin/index.php");
    }

    $sql_fetch = mysqli_fetch_array($sql);
}

if (isset($_POST['inputSpt'])) {
    $id_bidang = $_POST['id_bidang'];
    $no_surat = $_POST['no_surat'];
    $tgl_surat = date('Y-m-d', strtotime($_POST['tgl_surat']));
    $untuk = $_POST['untuk'];
    $tujuan = $_POST['tujuan'];
    $alamat = $_POST['alamat'];
    $waktu = $_POST['waktu'];

    // Random Code Surat
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $codeSurat  = str_shuffle($karakter);
    echo $codeSurat;

    $sqlInputSpt = mysqli_query($conn, "INSERT INTO tb_spt_pegawai values ('', '$codeSurat', $id_bidang, '$no_surat', '$tgl_surat', '$untuk', '$tujuan', '$alamat', '$waktu', '', $nip)");
    if ($sqlInputSpt) {
        echo '<script>alert("Berhasil Menambahkan Surat, Silahkan Lanjutkan dan Pilih Pegawai")</script>';
        header("location: pra_proses_spt.php?code=$codeSurat");
    }
}

?>

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Premium Bootstrap 5 Landing Page Template" />
    <meta name="keywords" content="bootstrap 5, premium, marketing, multipurpose" />
    <meta name="author" content="Coderthemes" />

    <!-- Site Title -->
    <title>Aplikasi Formulir Surat Menyurat </title>
    <!-- Site favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- Swiper js -->
    <link rel="stylesheet" href="css/swiper-bundle.min.css" type="text/css" />

    <!--Material Icon -->
    <link rel="stylesheet" type="text/css" href="css/materialdesignicons.min.css" />

    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="60">
    <!--Navbar Start-->
    <nav class="navbar navbar-expand-lg fixed-top navbar-custom navbar-light sticky-dark" id="navbar-sticky">
        <div class="container">
            <!-- LOGO -->
            <a class="logo text-uppercase" href="index.php">
                <img src="images/logo-jatim.png" style="width: 50px" class="logo-dark" />
                <img src="images/logo-jatim.png" style="width: 50px" alt="" class="logo-light" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto navbar-center" id="mySidenav">
                    <!-- <li class="nav-item">
                        <a href="#home" class="nav-link">Home</a>
                    </li> -->

                </ul>
                <ul class="navbar-nav navbar-center">
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </li> -->
                    <li class="nav-item">
                        <a href="#" class="btn btn-sm nav-btn" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <section class="section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 col-lg-6 text-center">
                    <h6 class="subtitle">How it <span class="fw-bold">Work</span></h6>
                    <h2 class="title">Sistem Formulir Surat</h2>
                    <p class="text-muted">Silahkan Pilih Jenis Surat yang akan dibuat dan isikan form yang diminta</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Surat Ijin</h5>
                            <p class="card-text">Memasukkan No Telp, Alamat, Alasan, Tanggal Ijin. Kemudian memilih tanda tangan atasan siapa yang dituju</p>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#suratIjinModal">Buat Surat</a>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Surat Lupa Absen</h5>
                            <p class="card-text">Fitur "Surat Lupa Absen" memungkinkan pengguna untuk menghasilkan surat permohonan lupa absen dengan cepat dan mudah. Pengguna hanya perlu memasukkan Nomor Induk Pegawai (NIP) dan tanggal lupa absen, dan sistem akan secara otomatis menghasilkan surat yang sesuai untuk keperluan mereka.</p>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#suratLupaAbsenModal">Buat Surat</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Surat Tugas</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#suratPerintahTugas">Buat Surat</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- faqs start -->
    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 col-lg-6 text-center">
                    <h6 class="subtitle"> <span class="fw-bold"></span></h6>
                    <h2 class="title">Tata Cara Membuat Formulir Surat</h2>
                    <p class="text-muted">Sed ut perspiciatis unde omnis iste natus error voluptatem accusantium doloremque rem aperiam.</p>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-4">
                    <img src="images/faq.png" alt="" class="img-fluid d-block mx-auto" />
                </div>

                <div class="col-lg-7 offset-lg-1">
                    <div class="accordion accordion-flush faqs-accordion mt-4 mt-lg-0" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                    Surat Ijin
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-secondary">
                                    Untuk bisa mengakses fitur buat surat ijin, user hanya perlu memasukkan NIP di form bagian atas, kemudian klik tombol CEK NIP. Setelah masuk silahkan memilih menu Surat Ijin, Dan memasukkan No Telp, Alamat, Alasan, Tanggal Ijin. Kemudian memilih tanda tangan atasan siapa yang dituju
                                </div>
                            </div>
                        </div>
                        <!-- accordion-header end -->

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Surat Lupa Absen
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-secondary">
                                    Fitur "Surat Lupa Absen" memungkinkan pengguna untuk menghasilkan surat permohonan lupa absen dengan cepat dan mudah. Pengguna hanya perlu memasukkan Nomor Induk Pegawai (NIP) dan tanggal lupa absen, dan sistem akan secara otomatis menghasilkan surat yang sesuai untuk keperluan mereka. Ini adalah solusi yang praktis dan efisien untuk mengatasi masalah lupa absen dalam lingkungan kerja.
                                </div>
                            </div>
                        </div>
                        <!-- accordion-header end -->

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    Surat Tugas
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-secondary">
                                    Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
                                </div>
                            </div>
                        </div>
                        <!-- accordion-header end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- faqs end -->

    <!-- footer & cta start -->
    <section class="footer bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 text-center text-lg-start">
                    <div class="footer-logo mb-4">
                        <a href="#">
                            <img src="images/logo-jatim.png" style="width: 100px;" alt="" />
                        </a>
                    </div>
                    <a href="#" class="text-white">dinkominfo@surabaya.go.id</a>
                    <p class="text-white">(031) 5312144 Psw. 384 / 241</p>

                    <h5 class="fs-18 mb-3 text-white">Follow Us</h5>
                    <ul class="list-inline mt-5">
                        <li class="list-inline-item">
                            <a href="https://www.facebook.com/sapawargakotasurabaya" class="footer-social-icon"><i class="mdi mdi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://twitter.com/sapawargasby" class="footer-social-icon"><i class="mdi mdi-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.instagram.com/sapawargasby" class="footer-social-icon"><i class="mdi mdi-instagram"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.youtube.com/user/MediaCenterPemkotSby" class="footer-social-icon"><i class="mdi mdi-youtube"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <h5 class="fs-22 mb-3 fw-semibold text-white">About Us</h5>
                            <ul class="list-unstyled footer-nav">
                                <li><a href="javascript:void(0);" class="footer-link">Home</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">FAQ</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Surat Ijin</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Surat Lupa Absen</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Surat Perintah Tugas</a></li>
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <div class="footer-tagline">
        <div class="container">
            <div class="row justify-content-between py-2">
                <div class="col-md-6">
                    <p class="text-white opacity-75 mb-0 fs-14">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Appexy - <a href="https://coderthemes.com/" class="text-white">Coderthemes.com</a>
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="javascript:void(0);" class="text-white opacity-75 fs-14">Terms Conditions & Policy</a>
                </div>
            </div>
        </div>
    </div>
    <!-- footer & cta end -->

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" class="back-to-top-btn btn btn-gradient-primary" id="back-to-top"><i class="mdi mdi-chevron-up"></i></a>






    <!-- Modal Surat Ijin -->

    <div class="modal fade" id="suratIjinModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <h4 class="mb-0">Cetak Surat Ijin</h4>
                        <p class="text-muted fs-15">Silahkan Masukkan NIP Anda</p>
                    </div>
                    <form action="proses_surat_ijin.php" method="POST" target="_blank">
                        <div class="mb-3">
                            <label for="emailAddress" class="form-label">No Telp</label>
                            <input required type="text" class="form-control" id="emailAddress" name="no_telp" placeholder="Ex. 0812345678" />
                        </div>
                        <div class="mb-3">
                            <label for="emailAddress" class="form-label">Alamat</label>
                            <textarea required name="alamat" id="alamat" cols="10" rows="4" style="font-size: 0.8rem;" placeholder="Alamat Lengkap" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="emailAddress" class="form-label">Alasan Ijin</label>
                            <input required type="text" class="form-control" id="emailAddress" name="alasan" placeholder="Ex. Sakit dll" />
                        </div>
                        <div class="mb-3">
                            <label for="emailAddress" class="form-label">Tanggal Ijin</label>
                            <input required type="date" name="tanggal_ijin" id="" class="form-control">
                        </div>

                        <?php
                        $sqlPegawai = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = $nip");
                        $fetchPegawai = mysqli_fetch_array($sqlPegawai);

                        $idJabatanJenis = $fetchPegawai['id_jabatan_jenis'];
                        $idBidang = $fetchPegawai['id_bidang'];

                        if ($idJabatanJenis == 2) {
                            $sqlTtd = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_jabatan_jenis = 1");
                            $fetchTtd = mysqli_fetch_array($sqlTtd);
                            $idPegawaittd = $fetchTtd['id_pegawai'];
                        ?>
                            <input type="hidden" name="idPegawaiTtd" value="<?php echo $idPegawaittd; ?>" id="">
                        <?php
                        } else if ($idJabatanJenis == 5 or $idJabatanJenis == 6) {
                            $sqlTtd = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_jabatan_jenis = 2 AND id_bidang = $idBidang");
                            $fetchTtd = mysqli_fetch_array($sqlTtd);
                            $idPegawaittd = $fetchTtd['id_pegawai'];
                        ?>
                            <input type="hidden" name="idPegawaiTtd" value="<?php echo $idPegawaittd; ?>" id="">
                        <?php
                        } else {
                            $sqlTtd = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_jabatan_jenis = 6 AND id_bidang = $idBidang");
                        ?>
                            <label for="">Pilih Tanda Tangan Atasan</label>
                            <select required class="form-control" name="idPegawaiTtd" id="">
                                <?php
                                while ($fetchTtd = mysqli_fetch_array($sqlTtd)) {
                                ?>
                                    <option value="<?= $fetchTtd['id_pegawai'] ?>"> <?= $fetchTtd['nama_pegawai'] ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        <?php
                        }
                        ?>

                        <br>
                        <input type="submit" value="Cetak Surat" name="cetakSuratIjin" class="btn btn-gradient-primary w-100">
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Surat Lupa Absen -->
    <div class="modal fade" id="suratLupaAbsenModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <h4 class="mb-0">Cetak Surat Lupa Absen</h4>
                        <p class="text-muted fs-15">Silahkan Masukkan Data Dibawah</p>
                    </div>
                    <form action="proses_surat_lupa_absen.php" method="POST" target="_blank">
                        <div class="mb-3">
                            <label for="emailAddress" class="form-label">Tanggal Lupa Absen</label>
                            <input required type="date" name="tanggal_lupa_absen" id="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <?php
                            $sqlPegawai = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = $nip");
                            $fetchPegawai = mysqli_fetch_array($sqlPegawai);

                            $idJabatanJenis = $fetchPegawai['id_jabatan_jenis'];
                            $idBidang = $fetchPegawai['id_bidang'];

                            if ($idJabatanJenis == 2) {
                                $sqlTtd = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_jabatan_jenis = 1");
                                $fetchTtd = mysqli_fetch_array($sqlTtd);
                                $idPegawaittd = $fetchTtd['id_pegawai'];
                            ?>
                                <input type="hidden" name="idPegawaiTtd" value="<?php echo $idPegawaittd; ?>" id="">
                            <?php
                            } else if ($idJabatanJenis == 5 or $idJabatanJenis == 6) {
                                $sqlTtd = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_jabatan_jenis = 2 AND id_bidang = $idBidang");
                                $fetchTtd = mysqli_fetch_array($sqlTtd);
                                $idPegawaittd = $fetchTtd['id_pegawai'];
                            ?>
                                <input type="hidden" name="idPegawaiTtd" value="<?php echo $idPegawaittd; ?>" id="">
                            <?php
                            } else {
                                $sqlTtd = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_jabatan_jenis = 6 AND id_bidang = $idBidang");
                            ?>
                                <label for="">Pilih Tanda Tangan Atasan</label>
                                <select required class="form-control" name="idPegawaiTtd" id="">
                                    <?php
                                    while ($fetchTtd = mysqli_fetch_array($sqlTtd)) {
                                    ?>
                                        <option value="<?= $fetchTtd['id_pegawai'] ?>"> <?= $fetchTtd['nama_pegawai'] ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            <?php
                            }
                            ?>
                        </div>

                        <input type="submit" value="Cetak Surat" name="cetakSuratLupaAbsen" class="btn btn-gradient-primary w-100">
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Surat Perintah Tugas -->
    <div class="modal fade" id="suratPerintahTugas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <h4 class="mb-0">Cetak Surat Perintah Tugas</h4>
                        <p class="text-muted fs-15">Silahkan Masukkan Data Anda</p>
                    </div>
                    <form action="" method="POST" target="_blank">
                        <div class="mb-3">
                            <label for="example-text-input" class="col-sm-10 col-form-label">Pil. Bidang</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="id_bidang" required>
                                    <option>Pilih Bidang</option>
                                    <?php
                                    $sqlBidang = mysqli_query($conn, "SELECT * FROM tb_bidang");
                                    while ($fetchBidang = mysqli_fetch_array($sqlBidang)) {
                                    ?>
                                        <option value="<?php echo $fetchBidang['id_bidang'] ?>"> <?php echo $idPegTtd = $fetchBidang['nama_bidang']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="example-text-input" class="col-sm-10 col-form-label">No Surat</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="no_surat" placeholder="Ex: 094/          /114.1/2022" id="example-text-input">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="example-text-input" class="col-sm-10 col-form-label">Tanggal Surat</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="date" name="tgl_surat" value="" id="example-date-input">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="example-text-input" class="col-sm-10 col-form-label">Untuk</label>
                            <div class="col-sm-10">
                                <textarea name="untuk" class="form-control" id="" cols="30" rows="3" placeholder="Ex: Melaksanakan Bimbingan Teknis Jabatan Fungsional"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="example-text-input" class="col-sm-10 col-form-label">Tujuan Surat</label>
                            <div class="col-sm-10">
                                <textarea name="tujuan" class="form-control" id="" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="example-text-input" class="col-sm-10 col-form-label">Alamat Tugas</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" class="form-control" id="" cols="30" rows="3" placeholder=" Ex: Kantor Kota Jl. Simpang Ijen - Malang"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="example-text-input" class="col-sm-10 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="waktu" placeholder="ex : tanggal 15 s.d. 16 Desember 2022." id="example-text-input">
                            </div>
                        </div>
                        <br><br>
                        <input type="submit" value="Tambah Personil" name="inputSpt" class="btn btn-gradient-primary w-100">
                </div>
                <br>
                <br>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <h4 class="mb-0">Login Admin</h4>
                        <p class="text-muted fs-15">Silahkan Masukkan Username dan Password</p>
                    </div>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="emailAddress" class="form-label">Username</label>
                            <input type="text" class="form-control" id="emailAddress" name="username" placeholder="Username" />
                        </div>
                        <div class="mb-3">
                            <label for="emailAddress" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                        </div>

                        <input type="submit" value="Login" name="login" class="btn btn-gradient-primary w-100">
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- javascript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- counter -->
    <script src="js/counter.init.js"></script>
    <!-- swiper -->
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/swiper.js"></script>
    <script src="js/app.js"></script>
</body>

</html>