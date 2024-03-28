<?php
include "koneksi.php";

$sql = mysqli_query($conn, "Select * from tb_pegawai");

if (ISSET($_POST['input'])) {
    $nip = $_POST['nip'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $jabatan = $_POST['jabatan'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
}
 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Sistem Surat </title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="../images/logo-sisurat.png">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <!-- Top Bar Start -->
                <div class="topbar">

                    <nav class="navbar-custom">

                        <!-- Top Navbar -->
                        <ul class="list-inline float-right mb-0">

                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/users/avatar-6.jpg" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5>Welcome</h5>
                                    </div>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5 text-muted"></i> My Wallet</a>
                                    <a class="dropdown-item" href="#"><span class="badge badge-success float-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                </div>
                            </li>
                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left waves-light waves-effect">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                        </ul>

                        <div class="clearfix"></div>
                    </nav>
                </div>
                <!-- Top Bar End -->

                <div class="page-content-wrapper ">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="btn-group float-right">
                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                            <li class="breadcrumb-item"><a href="#">Pegawai</a></li>
                                            <li class="breadcrumb-item active">Data Pegawai</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Pegawai</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="icon-contain">
                                                    <div class="row">
                                                        <div class="col-2 align-self-center">
                                                            <i class="fas fa-users text-gradient-warning"></i>
                                                        </div>
                                                        <div class="col-10 text-right">
                                                            <?php
                                                            $fetch_pegawai_numb = mysqli_num_rows($sql);
                                                            echo $fetch_pegawai_numb;
                                                            ?>
                                                            </h5>
                                                            <p class="mb-0 font-12 text-muted">Pegawai</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="mt-0 header-title">Form Input Pegawai</h4>
                                        <form action="proses_input.php" method="POST">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">NIP</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="nip" placeholder="No NIP Tanpa Spasi">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="nama_pegawai" placeholder="No NIP" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="tempat_lahir" placeholder="Kota Tempat Lahir" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-date-input" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="date" name="tanggal_lahir" value="" id="example-date-input">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Jabatan</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="jabatan" required>
                                                        <option>Pilih Jabatan</option>
                                                        <?php
                                                        $sql_jabatan = mysqli_query($conn, "SELECT * FROM tb_jabatan");
                                                        while ($fetch_jabatan = mysqli_fetch_array($sql_jabatan)) {
                                                        ?>
                                                            <option value="<?php echo $fetch_jabatan['id_jabatan']; ?>"><?php echo $fetch_jabatan['jabatan_nama']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Pangkat Golongan</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="pangkat_golongan" required>
                                                        <option>Pangkat Golongan Ruang</option>
                                                        <?php
                                                        $sql_pangkat_golongan = mysqli_query($conn, "SELECT * FROM tb_pangkat_golongan");
                                                        while ($fetch_pangkat_golongan = mysqli_fetch_array($sql_pangkat_golongan)) {
                                                        ?>
                                                            <option value="<?php echo $fetch_pangkat_golongan['id_pangkat_golongan']; ?>"><?php echo $fetch_pangkat_golongan['pangkat']; ?>-<?php echo $fetch_pangkat_golongan['golongan']; ?>-<?php echo $fetch_pangkat_golongan['ruang']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Bidang</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="pangkat_golongan" required>
                                                        <option>Pilih Bidang</option>
                                                        <?php
                                                        $sql_bidang = mysqli_query($conn, "SELECT * FROM tb_bidang");
                                                        while ($fetch_bidang = mysqli_fetch_array($sql_bidang)) {
                                                        ?>
                                                            <option value="<?php echo $fetch_bidang['id_pangkat_golongan']; ?>"><?php echo $fetch_bidang['nama_bidang']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-date-input" class="col-sm-2 col-form-label">Tmt Jabatan</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="date" name="tmt_jabatan" value="" id="example-date-input">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-date-input" class="col-sm-2 col-form-label">Tmt Pensiun</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="date" name="tmt_pensiun" value="" id="example-date-input">
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <input type="submit" value="Input" class="btn btn-block btn-sm btn-primary">
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <!-- end row -->

                    </div><!-- container -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <footer class="footer">
                © 2022 Zoogler by Mannatthemes.
            </footer>

        </div>
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center bg-logo">
                    <a href="index.php" class="logo"><i class="mdi mdi-bowling text-success"></i>Si-surat</a>
                    <!-- <a href="index.php" class="logo"><img src="assets/images/logo.png" height="24" alt="logo"></a> -->
                </div>
            </div>
            <div class="sidebar-user">
                <img src="assets/images/users/avatar-6.jpg" alt="user" class="rounded-circle img-thumbnail mb-1">
                <h6 class="">Hi, Admin</h6>
                <p class=" online-icon text-dark"><i class="mdi mdi-record text-success"></i>online</p>

            </div>

            <div class="sidebar-inner slimscrollleft">

            <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">Main</li>

                            <li>
                                <a href="index.php" class="waves-effect">
                                    <i class="dripicons-device-desktop"></i>
                                    <span> Dashboard <span class="badge badge-pill badge-primary float-right">7</span></span>
                                </a>
                            </li>

                            <li class="menu-title">Pegawai</li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-jewel"></i> <span>Pegawai </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="pegawai_table.php">Data Pegawai</a></li>
                                    <li><a href="pegawai_jabatan.php">Data Jabatan</a></li>
                                    <li><a href="pegawai_pangkat_gol.php">Data Pangkat Golongan</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="surat_ijin.php" class="waves-effect">
                                    <i class="dripicons-document-new"></i>
                                    <span> TTD Surat Ijin</span>
                                </a>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-document-new"></i> <span>Surat Ijin</span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="#">Data Surat Ijin</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-document-new"></i> <span>SPT </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="#">Data SPT</a></li> 
                                    <li><a href="surat_perjalanan_dinas.php">Buat SPT</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->

        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->


    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <script src="assets/plugins/chart.js/chart.min.js"></script>
    <script src="assets/pages/dashboard.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>


</body>

</html>