<?php
include "koneksi.php";

$sql = mysqli_query($conn, "Select * from tb_pangkat_golongan");
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
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
                    <a href="index.php" class="logo"><i class="mdi mdi-bowling text-success"></i> Si-Surat</a>
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
                                            <li class="breadcrumb-item active">Data Pangkat & Golongan</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Pegawai</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->


                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="mt-0 header-title">Tabel Data Pangkat & Golongan Pegawai</h4>
                                    <a href="pegawai_input.php" class="btn btn-primary btn-sm my-2">Input Pangkat & Golongan</a>
                                    <table id="tablePegawai" class="table mb-0" id="my-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pangkat</th>
                                                <th>Golongan</th>
                                                <th>Ruang</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            while ($fetch_pangkat_gol = mysqli_fetch_array($sql)) {

                                            ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $fetch_pangkat_gol['pangkat'] ?></td>
                                                    <td><?php echo $fetch_pangkat_gol['golongan'] ?></td>
                                                    <td><?php echo $fetch_pangkat_gol['ruang'] ?></td>
                                                    <td>
                                                        <a href="pegawai_edit_pangkat_gol.php?id_pegawai=<?php echo $fetch_pangkat_gol['id_pangkat_golongan'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                        <a href="pegawai_hapus_pangkat_gol.php?id_pegawai=<?php echo $fetch_pangkat_gol['id_pangkat_golongan'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash">
                                                    </td>
                                                </tr>
                                            <?php
                                                $no++;
                                            }
                                            ?>


                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                    <!-- end row -->

                </div><!-- container -->

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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script>
        new DataTable('#tablePegawai');
    </script>

</body>

</html>