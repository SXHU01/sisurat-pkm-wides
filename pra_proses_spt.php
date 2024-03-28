<?php
include "admin/koneksi.php";
session_start();

$nip = $_SESSION['sess_nip'];

if ($_SESSION['status'] != "valid") {
    header("location: index.php");
}

if (isset($_GET['code'])) {
    $codeSurat = $_GET['code'];
    $sqlSpt = mysqli_query($conn, "SELECT * FROM tb_spt_pegawai where code_surat = '$codeSurat'");
    $fetchSpt = mysqli_fetch_array($sqlSpt);
    $idBidang = $fetchSpt['id_spt_bidang'];
}

if (isset($_POST['inputPersonil'])) {
    $id_user = $_POST['nip'];
    $sqlcheckNip = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = $id_user");
    $numSqlCheckNip = mysqli_num_rows($sqlcheckNip);
    if ($numSqlCheckNip > 0) {
        $sqlTambahPersonil = mysqli_query($conn, "INSERT INTO tb_spt_personil values ('', '$codeSurat', '$id_user')");
        if ($sqlTambahPersonil) {
            echo '<script>alert("Berhasil Menambahkan Personil")</script>';
            header("location: pra_proses_spt.php?code=$codeSurat");
        } else {
            echo '<script>alert("gagal Menambahkan Personil")</script>';
            header("location: pra_proses_spt.php?code=$codeSurat");
        }
    } else {
        echo '<script>alert("Pegawai Dengan NIP Tersebut Tidak Ditemukan")</script>';
        header("location: pra_proses_spt.php?code=$codeSurat");
    }
}

if (isset($_GET['id_delete'])) {
    $idDelete = $_GET['id_delete'];
    echo "ID yang akan dihapus: " . $idDelete; // Tambahkan baris ini untuk debugging
    $sqlDelete = mysqli_query($conn, "DELETE FROM tb_spt_personil WHERE id_spt_user = $idDelete");
    header("location: pra_proses_spt.php?code=$codeSurat");
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="icon-contain">
                                            <div class="row my-5">
                                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPersonil">Tambah Personil</a>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <td>NIP</td>
                                                            <td>Nama</td>
                                                            <td>Aksi</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sqlSptPegawai = mysqli_query($conn, "SELECT * FROM tb_spt_personil where code_surat = '$codeSurat'");

                                                        while ($fetchSptPegawai = mysqli_fetch_array($sqlSptPegawai)) {
                                                            $id_pegawai = $fetchSptPegawai['id_user'];
                                                            $sqlPegawai = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = $id_pegawai");
                                                            $fetchPegawai = mysqli_fetch_array($sqlPegawai);
                                                        ?>
                                                            <tr>
                                                                <td><?= $fetchPegawai['id_pegawai']; ?></td>
                                                                <td><?= $fetchPegawai['nama_pegawai']; ?></td>
                                                                <td><a href="pra_proses_spt.php?code=<?php echo $codeSurat; ?>&id_delete=<?php echo $fetchSptPegawai['id_spt_user']; ?>" class="btn btn-sm btn-danger">Del</a>
                                                                </td>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }



                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="icon-contain">
                                            <div class="row my-5">
                                                <h5>Detail Surat</h5>
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td>Nomor Surat</td>
                                                        <td>:</td>
                                                        <td><?php echo $fetchSpt['no_spt']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bidang</td>
                                                        <td>:</td>
                                                        <td><?php
                                                            $idBidang =  $fetchSpt['id_spt_bidang'];
                                                            $sqlBidang = mysqli_query($conn, "SELECT * FROM tb_bidang where id_bidang = $idBidang");
                                                            $fetchBidang = mysqli_fetch_array($sqlBidang);
                                                            echo $fetchBidang['nama_bidang'];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Surat</td>
                                                        <td>:</td>
                                                        <td><?php echo $fetchSpt['tanggal_spt']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Untuk</td>
                                                        <td>:</td>
                                                        <td><?php echo $fetchSpt['untuk']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tujuan</td>
                                                        <td>:</td>
                                                        <td><?php echo $fetchSpt['tujuan']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>:</td>
                                                        <td><?php echo $fetchSpt['alamat']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Waktu</td>
                                                        <td>:</td>
                                                        <td><?php echo $fetchSpt['waktu']; ?></td>
                                                    </tr>
                                                </table>

                                                <a href="#" class="btn btn-success btn-block" data-bs-toggle="modal" data-bs-target="#modalttd">Cetak Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>


        </div>
    </section>


    <!-- footer & cta start -->
    <section class="footer bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 text-center text-lg-start">
                    <div class="footer-logo mb-4">
                        <a href="#">
                            <img src="images/logo-light.png" alt="" />
                        </a>
                    </div>
                    <a href="#" class="text-white">Hello@coderthemes.com</a>
                    <p class="text-white">+01 ( 1234 567 890 )</p>

                    <h5 class="fs-18 mb-3 text-white">Follow Us</h5>
                    <ul class="list-inline mt-5">
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="footer-social-icon"><i class="mdi mdi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="footer-social-icon"><i class="mdi mdi-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="footer-social-icon"><i class="mdi mdi-linkedin"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="footer-social-icon"><i class="mdi mdi-skype"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <h5 class="fs-22 mb-3 fw-semibold text-white">About Us</h5>
                            <ul class="list-unstyled footer-nav">
                                <li><a href="javascript:void(0);" class="footer-link">Support Center</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Customer Support</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">About Us</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Copyright</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Popular Campaign</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <h5 class="fs-22 mb-3 fw-semibold text-white">Our Information</h5>
                            <ul class="list-unstyled footer-nav">
                                <li><a href="javascript:void(0);" class="footer-link">Return Policy</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Privacy Policy</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Terms & Conditions</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Site Map</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Store Hours</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <h5 class="fs-22 mb-3 fw-semibold text-white">My Account</h5>
                            <ul class="list-unstyled footer-nav">
                                <li><a href="javascript:void(0);" class="footer-link">Press Inquiries</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Social Media Directories</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Images & B-roll</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Permissions</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Speaker Requests</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <h5 class="fs-22 mb-3 fw-semibold text-white">Policy</h5>
                            <ul class="list-unstyled footer-nav">
                                <li><a href="javascript:void(0);" class="footer-link">Application Security</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Softwere Principles</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Unwanted Softwere Policy</a></li>
                                <li><a href="javascript:void(0);" class="footer-link">Risponsible Supply Chain</a></li>
                            </ul>
                        </div>
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






    <!-- Modal Tambah Personil -->

    <div class="modal fade" id="modalPersonil" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <h4 class="mb-0">Tambah Pegawai Surat Perintah Tugas</h4>
                        <p class="text-muted fs-15">Silahkan Masukkan NIP Personil</p>
                    </div>
                    <form action="" method="POST" target="_blank">
                        <div class="mb-3">
                            <label for="emailAddress" class="form-label">NIP</label>
                            <input required type="text" name="nip" placeholder="Tanpa Spasi" id="" class="form-control">
                        </div>

                        <input type="submit" value="Cetak Surat" name="inputPersonil" class="btn btn-gradient-primary w-100">
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalttd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <h4 class="mb-0">Tambah Pegawai Surat Perintah Tugas</h4>
                        <p class="text-muted fs-15">Silahkan Masukkan NIP Personil</p>
                    </div>
                    <form action="cetak_spt.php" method="POST" target="_blank">
                        <div class="mb-3">
                            <input type="hidden" name="id_spt" value="<?php echo $codeSurat ?>">
                        </div>
                        <div class="mb-3">
                            <select name="ttd" id="" class="form-control">
                                <?php
                                $sqlttdKepala = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_jabatan_jenis = 1");

                                while ($fetchttdKepala = mysqli_fetch_array($sqlttdKepala)) {
                                ?>
                                    <option value="<?= $fetchttdKepala['id_pegawai'] ?>"><?= $fetchttdKepala['nama_pegawai'] ?></option>
                                <?php
                                }
                                ?>
                                <?php
                                $sqlttd = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_bidang = $idBidang AND id_jabatan_jenis = 2");
                                while ($fetchttd = mysqli_fetch_array($sqlttd)) {
                                ?>
                                    <option value="<?= $fetchttd['id_pegawai'] ?>"><?= $fetchttd['nama_pegawai'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <input type="submit" value="Cetak Surat" name="cetakSurat" class="btn btn-gradient-primary w-100">
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