<?php
include "koneksi.php";

if (isset($_GET['code'])) {
    $codeSurat = $_GET['code'];
    $sqlSpt = mysqli_query($conn, "SELECT * FROM tb_spt_pegawai where code_surat = '$codeSurat'");
    $fetchSpt = mysqli_fetch_array($sqlSpt);
    $idBidang = $fetchSpt['id_spt_bidang'];
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

    $sqlInputSpt = mysqli_query($conn, "INSERT INTO tb_spt_pegawai values ('', '$codeSurat', $id_bidang, '$no_surat', '$tgl_surat', '$untuk', '$tujuan', '$alamat', '$waktu', '', 'Admin')");
    if ($sqlInputSpt) {
        echo '<script>alert("Berhasil Menambahkan Surat, Silahkan Lanjutkan dan Pilih Pegawai")</script>';
        header("location: input_spt.php?code=$codeSurat");
    }
}



if (isset($_POST['inputPersonil'])) {
    $id_user = $_POST['nip'];
    $sqlcheckNip = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = $id_user");
    $numSqlCheckNip = mysqli_num_rows($sqlcheckNip);
    if ($numSqlCheckNip > 0) {
        $sqlTambahPersonil = mysqli_query($conn, "INSERT INTO tb_spt_personil values ('', '$codeSurat', '$id_user')");
        if ($sqlTambahPersonil) {
            echo '<script>alert("Berhasil Menambahkan Personil")</script>';
            header("location: input_spt.php?code=$codeSurat");
        } else {
            echo '<script>alert("gagal Menambahkan Personil")</script>';
            header("location: input_spt.php?code=$codeSurat");
        }
    } else {
        echo '<script>alert("Pegawai Dengan NIP Tersebut Tidak Ditemukan")</script>';
        header("location: input_spt.php?code=$codeSurat");
    }
}

if (isset($_GET['id_delete'])) {
    $idDelete = $_GET['id_delete'];
    echo "ID yang akan dihapus: " . $idDelete; // Tambahkan baris ini untuk debugging
    $sqlDelete = mysqli_query($conn, "DELETE FROM tb_spt_personil WHERE id_spt_user = $idDelete");
    header("location: input_spt.php?code=$codeSurat");
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
                    <a href="index.php" class="logo"><i class="mdi mdi-bowling text-success"></i> Zoogler</a>
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
                                            <li class="breadcrumb-item"><a href="#">SPT</a></li>
                                            <li class="breadcrumb-item active">Input SPT</li>
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
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="icon-contain">
                                                    <div class="row">
                                                        <button type="button" class="btn btn-sm btn-primary waves-effect waves-light my-3" data-toggle="modal" data-target="#myModal">Tambah Personil</button>

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
                                                                        <td><a href="input_spt.php?code=<?php echo $codeSurat; ?>&id_delete=<?php echo $fetchSptPegawai['id_spt_user']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash" style="font-size: 14px;"></i></a>
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
                                                    <div class="row">
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
                                                                <td>Keperluan</td>
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
                                                        <button type="button" class="btn btn-block btn-gradient-success waves-effect waves-light my-3" data-toggle="modal" data-target="#modalTtd">Cetak Surat</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

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

    <!-- Modals -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Form Buat Surat Perintah Tugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Masukkan NIP Pegawai</h4>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">NIP</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="nip" placeholder="Tanpa Spasi" id="example-text-input">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <input type="submit" name="inputPersonil" value="Input" class="btn btn-primary">
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Modals -->
    <!-- Modals -->
    <div id="modalTtd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Form Buat Surat Perintah Tugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form method="POST" action="../cetak_spt.php">
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Pilih Tanda Tangan Kepala</h4>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pilih</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" name="id_spt" value="<?php echo $codeSurat?>">
                                        <select name="ttd" id="" class="form-control">
                                            <?php
                                                $sqlttdKepala = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_jabatan_jenis = 1");
                                                
                                                while($fetchttdKepala = mysqli_fetch_array($sqlttdKepala)){
                                                    ?>
                                                         <option value="<?= $fetchttdKepala['id_pegawai'] ?>"><?= $fetchttdKepala['nama_pegawai'] ?></option>
                                                    <?php
                                                }
                                            ?>
                                            <?php
                                            $sqlttd = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_bidang = $idBidang AND id_jabatan_jenis = 2");
                                            while ($fetchttd = mysqli_fetch_array($sqlttd)){
                                                ?>
                                                    <option value="<?= $fetchttd['id_pegawai'] ?>"><?= $fetchttd['nama_pegawai'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <input type="submit" name="cetakSurat" value="Input" class="btn btn-primary">
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

    <!-- App js -->
    <script src="assets/js/app.js"></script>


</body>

</html>