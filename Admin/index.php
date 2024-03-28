<?php
    include "koneksi.php";
    session_start();

    if ($_SESSION['level'] != "Admin"){
        header("location: ../index.php");
        exit;  
    }
    $username = $_SESSION['username'];
    $sqlAdmin = mysqli_query($conn, "SELECT * from tb_admin where username = '$username'");
    $fetchAdmin = mysqli_fetch_array($sqlAdmin);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Sistem Informasi Formulir Surat</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

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
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center bg-logo">
                    <a href="index.php" class="logo"><img src="../images/logo-sisurat.png" style="width: 50px;" alt="" srcset=""> Si-Surat</a>
                    <!-- <a href="index.php" class="logo"><img src="assets/images/logo.png" height="24" alt="logo"></a> -->
                </div>
            </div>
            <div class="sidebar-user">
                <img src="../images/user.jpg" alt="user" class="rounded-circle img-thumbnail mb-1">
                <h6 class=""><?= $fetchAdmin['nama'] ?></h6>
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
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->

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
                                    <img src="../images/user.jpg" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5>Welcome</h5>
                                    </div>

                                    <a class="dropdown-item" href="logout.php"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
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
                                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->
                        <!-- <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="container">
                                                <ul class="list-inline text-center mt-3">
                                                    <li class="list-inline-item">
                                                        <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="pegawai_table.php" role="button"><i class="fab fa-simple me-2"></i>Data Pegawai</a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="#" role="button"><i class="fab fa-simple me-2"></i>Data Pegawai</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> 
                                  
                                </div>
                                                      
                            </div> -->


                        <!-- end row -->

                    </div><!-- container -->
                    <section id="app">
                        <div class="container">
                            <ul class="list-inline text-center mt-3">
                                <li class="list-inline-item">
                                    <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="pegawai_table.php" role="button"><i class="fab fa-simple me-2"></i>Data Pegawai</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="pegawai_jabatan.php" role="button"><i class="fab fa-simple me-2"></i>Data Jabatan</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="pegawai_pangkat_gol.php" role="button"><i class="fab fa-simple me-2"></i>Data Pangkat Golongan</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="surat_perjalanan_dinas.php" role="button"><i class="fab fa-simple me-2"></i>Buat Surat Tugas</a>
                                </li>
                            </ul>
                        </div>
                    </section>

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <footer class="footer">
                © 2024 Si-Surat by Puskesmas Wiradesa.
            </footer>

        </div>
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
