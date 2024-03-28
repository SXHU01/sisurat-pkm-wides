<?php

include "admin/koneksi.php";
if (isset($_POST['cetakSuratIjin'])){
    
session_start();

$nip = $_SESSION['sess_nip'];
$nipPegawaiTtd = $_POST['idPegawaiTtd'];


$no_telp = $_POST['no_telp'];
$alamat = $_POST['alamat'];
$alasan = $_POST['alasan'];
$tanggal_ijin = $_POST['tanggal_ijin'];
$tanggal = date('d-m-Y');

$sqlInput = mysqli_query($conn, "INSERT INTO req_surat_ijin values ('', $nip, '$alamat', '$alasan', '$tanggal_ijin', '$tanggal')");



$sql_pegawai = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = '$nip'");

$fetch_pegawai = mysqli_fetch_array($sql_pegawai);


$nama = $fetch_pegawai['nama_pegawai'];
$id_jabatan = $fetch_pegawai['id_jabatan'];
$id_pangkat_golongan = $fetch_pegawai['id_pangkat_gol'];




$sql_pangkat_golongan = mysqli_query($conn, "SELECT * FROM tb_pangkat_golongan where id_pangkat_golongan = $id_pangkat_golongan");
$fetch_pangkat_gol = mysqli_fetch_array($sql_pangkat_golongan);
$pangkat = $fetch_pangkat_gol['pangkat'];
$golongan = $fetch_pangkat_gol['golongan'];
$ruang = $fetch_pangkat_gol['ruang'];

$sql_jabatan = mysqli_query($conn, "SELECT * FROM tb_jabatan where id_jabatan = $id_jabatan");
$fetch_jabatan = mysqli_fetch_array($sql_jabatan);
$jabatan = $fetch_jabatan['jabatan_nama'];


$sqlPegawaiTtd = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = $nipPegawaiTtd");
$fetchPegawaiTtd = mysqli_fetch_array($sqlPegawaiTtd);

$namaPegawaiTtd = $fetchPegawaiTtd['nama_pegawai'];

$ttdPegawaiTtd = mysqli_query($conn, "SELECT * FROM tb_ttd where id_pegawai = $nipPegawaiTtd");
$fetchttdPegawaittd = mysqli_fetch_array($ttdPegawaiTtd);

if ($fetchttdPegawaittd == null){
    $file = "blank.jpg";
} else {
    $file = $fetchttdPegawaittd['file_ttd'];
}


// Query Ambil Data Tabel Tanda Tangan (tb_ttd)
}

require_once __DIR__ . '/vendor/autoload.php';




// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=document.pdf");

// Read the file content and output it
readfile("document.pdf");



$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    

    
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


<style>
    body {
        font-family: "Times New Roman", Times, serif;
        font-size: 12px;
    }
    h2 {
        font-family: "Times New Roman", Times, serif;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        line-height: 2;
    }
    .header {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-bottom: 30px;
    }
    .container {
        padding: 1cm;
    }
    table {
        font-family: "Times New Roman", Times, serif;
        font-size: 12px;
    }

    .table-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .table-top, .table-middle {
        margin: 0 1cm;
    }
    .table tr td{
        height: 30px;
    }

    img {
        width: 100px;
    }

    .table-bottom tr td{
        text-align: center;
    }
</style>

</head>
<body>
<div class="container">
<div class="header">
    <h2>FORMULIR PENGAJUAN IJIN</h2>
    <h2>DINAS KOMUNIKASI DAN INFORMATIKA PROVINSI JAWA TIMUR</h2>
    <h2>TAHUN 2023</h2>
    <br>
</div>
<div class="table-container">
    <table class="table table-top">
        <tr>
            <td>NAMA</td>
            <td>:</td>
            <td>'.$nama.'</td>
        </tr>
        <br>
       
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td>'.$nip.'</td>
        </tr>
        <tr>
            <td>PANGKAT / GOLONGAN</td>
            <td>:</td>
            <td>'.$pangkat.' / '.$golongan.'</td>
        </tr>
        <tr>
            <td>JABATAN</td>
            <td>:</td>
            <td>'.$jabatan.'</td>
        </tr>
        <tr>
            <td>TGL. IJIN </td>
            <td>:</td>
            <td>'.$tanggal_ijin.'</td>
        </tr>
        <tr>
            <td>ALASAN </td>
            <td>:</td>
            <td>'.$alasan.'</td>
        </tr>
        <tr>
            <td>ALAMAT </td>
            <td>:</td>
            <td>'.$alamat.'</td>
        </tr>
        <tr>
            <td>KONTAK PERSON </td>
            <td>:</td>
            <td>'.$no_telp.'</td>
        </tr>
    </table>
</div>
<br>
<br>

<div class="table-container">
    
    <table class="table table-bottom">
        <tr>
            <td></td>
            <td style="text-align: center">Surabaya, '.$tanggal.'</td>
            <br>
        <br>
        </tr>
        <br>
        <br>
        <tr style="text-align: center;">
            <td style="text-align: center;">Mengetahui: <br> Atasan Langsung</td>
            <td>Pengaju Ijin</td>
        </tr>
        <tr style="text-align: center;">
            <td style="margin: 0;"><img src="images/ttd/'.$file.'" alt="" ></td>
            <td></td>
        </tr>
        <tr style="text-align: center;">
            <td>'.$namaPegawaiTtd.' <br> NIP. '.$nipPegawaiTtd.'</td>
            <td>'.$nama.' <br> NIP: '.$nip.'</td>
        </tr>
    </table>
</div>
</div>
</body>
</html>
';
// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output("");
?>