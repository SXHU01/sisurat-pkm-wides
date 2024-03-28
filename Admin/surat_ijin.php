<?php
include "koneksi.php";

$sql = mysqli_query($conn, "SELECT * FROM tb_ttd");

if (isset($_POST['tambahTtd'])) {

    $id_pegawai = $_POST['id_pegawai'];


    $sqlCheckPegawai = mysqli_query($conn, "SELECT * FROM tb_ttd where id_pegawai = $id_pegawai");
    $numCheckPegawai = mysqli_num_rows($sqlCheckPegawai);
    if ($numCheckPegawai >= 1) {
        echo '<script>alert("Tanda Tangan Kepala atas bidang tersebut sudah Terisi, Untuk Mengganti silahkan melalui tombol edit pada tabel data Tanda Tangan")</script>';
        header("location: surat_ijin.php");
    } else {
        $sqlCekIdPegawai = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = $id_pegawai");
        $numSqlCekIdPegawai = mysqli_num_rows($sqlCekIdPegawai);

        if ($numSqlCekIdPegawai < 1) {
            echo '<script>alert("NIP Salah")</script>';
        }

        // ambil data file
        $namaFile = $_FILES['file_ttd']['name'];
        $namaSementara = $_FILES['file_ttd']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        $dirUpload = "../images/ttd/";

        // pindahkan file
        $terupload = move_uploaded_file($namaSementara, $dirUpload . $namaFile);

        if ($terupload) {
            $sqlInputTtd = mysqli_query($conn, "INSERT into tb_ttd values ('', $id_pegawai, '$namaFile')");
            if ($sqlInputTtd) {
                echo '<script>alert("Berhasil Mengupdate Data")</script>';
                header("location: surat_ijin.php");
            } else {
                echo '<script>alert("gagal Mengupdate Data")</script>';
            }
        } else {
            echo '<script>alert("Upload Gagal, Silahkan Coba Lagi!")</script>';
        }
    }
}


if (isset($_GET['idDelete'])) {
    $id_pegawai = $_GET['idDelete'];

    $sqlDelete = mysqli_query($conn, "DELETE FROM tb_ttd where id_pegawai = $id_pegawai");
    header("location: surat_ijin.php");
}

if (isset($_POST['edit'])) {
    $idPegawai = $_POST['id_pegawai'];
    // ambil data file
    $namaFile = $_FILES['file_ttd']['name'];
    $namaSementara = $_FILES['file_ttd']['tmp_name'];

    // tentukan lokasi file akan dipindahkan
    $dirUpload = "../images/ttd/";

    // pindahkan file
    $terupload = move_uploaded_file($namaSementara, $dirUpload . $namaFile);

    if ($terupload) {
        $sqlEditTtd = mysqli_query($conn, "UPDATE tb_ttd set file_ttd = '$namaFile' where id_pegawai = $idPegawai");
        if ($sqlEditTtd) {
            echo '<script>alert("Berhasil Menambahkan Data")</script>';
            header("location: surat_ijin.php");
        } else {
            echo '<script>alert("gagal Menambahkan Data")</script>';
        }
    } else {
        echo '<script>alert("Upload Gagal, Silahkan Coba Lagi!")</script>';
    }
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

    <link rel="shortcut icon" href="assets/images/favicon.ico">

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
                                            <li class="breadcrumb-item active">Data Pegawai</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Pegawai</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="mt-0 header-title">Tabel Data Pegawai</h4>
                                        <button type="button" class="btn btn-primary waves-effect waves-light my-3" data-toggle="modal" data-target="#myModal">Tambah TTD</button>

                                        <table id="tablePegawai" class="table mb-0" id="my-table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIP</th>
                                                    <th>Nama</th>
                                                    <th>TTD</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                while ($fetch_ttd = mysqli_fetch_array($sql)) {

                                                ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php
                                                            $id_pegawai = $fetch_ttd['id_pegawai'];
                                                            $sql_pegawai = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = $id_pegawai");
                                                            $fetch_pegawai = mysqli_fetch_array($sql_pegawai);

                                                            echo $fetch_pegawai['id_pegawai'];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo $fetch_pegawai['nama_pegawai'];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <img class="rounded" src="../images/ttd/<?= $fetch_ttd['file_ttd'] ?>" style="width: 100px;" alt="" srcset="">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEdit<?php echo $fetch_pegawai['id_pegawai'] ?>"><i class="fa fa-edit"></i></button>
                                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete<?php echo $fetch_pegawai['id_pegawai'] ?>"><i class="fa fa-trash"></i></button>



                                                            <div id="modalEdit<?php echo $fetch_pegawai['id_pegawai'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title mt-0" id="myModalLabel">Form Edit Tanda Tangan </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <form method="post" enctype="multipart/form-data">
                                                                            <div class="modal-body">
                                                                                <div class="card">
                                                                                    <div class="card-body">


                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-10">
                                                                                                <input class="form-control" type="hidden" name="id_pegawai" value="<?php echo $fetch_pegawai['id_pegawai'] ?>" placeholder="No NIP Tanpa Spasi" id="example-text-input">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card">
                                                                                            <div class="card-body">
                                                                                                <h4 class="mt-0 header-title">Upload File Tanda Tangan</h4>
                                                                                                <p class="text-muted mb-4 font-13">Must: jpg, jpeg or png. Recomendation: with transparent background</p>
                                                                                                <input required type="file" name="file_ttd" id="input-file-now" class="dropify" accept="image/png, image/jpeg, image/jpg" />
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                                                <input type="submit" name="edit" value="Input" class="btn btn-primary">
                                                                            </div>
                                                                        </form><!-- /.modal-content -->
                                                                    </div><!-- /.modal-dialog -->
                                                                </div><!-- /.modal -->
                                                            </div>
                                                            <div id="modalDelete<?php echo $fetch_pegawai['id_pegawai'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title mt-0" id="myModalLabel">Form Edit Tanda Tangan </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Anda Yakin Ingin menghapus Data Ini ?</p>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                                            <a href="surat_ijin.php?idDelete=<?php echo $fetch_pegawai['id_pegawai'] ?>" class="btn btn-danger">Hapus</a>
                                                                        </div>
                                                                    </div><!-- /.modal-dialog -->
                                                                </div><!-- /.modal -->
                                                            </div>
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
                © 2022 Zoogler by Mannatthemes.
            </footer>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->


    <!-- Modals -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Form Input Tanda Tangan Kepala</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Masukkan Data Pegawai</h4>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">NIP</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="id_pegawai" placeholder="No NIP Tanpa Spasi" id="example-text-input">
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Upload File Tanda Tangan</h4>
                                        <p class="text-muted mb-4 font-13">Must: jpg, jpeg or png. Recomendation: with transparent background</p>
                                        <input required type="file" name="file_ttd" id="input-file-now" class="dropify" accept="image/png, image/jpeg, image/jpg" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <input type="submit" name="tambahTtd" value="Input" class="btn btn-primary">
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Modals -->


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