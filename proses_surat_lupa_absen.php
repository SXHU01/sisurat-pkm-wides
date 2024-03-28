<?php

include "admin/koneksi.php";

if (isset($_POST['cetakSuratLupaAbsen'])) {

    session_start();

    $nip = $_SESSION['sess_nip'];
    $tanggalLupaAbsen = $_POST['tanggal_lupa_absen'];
    $nipPegawaiTtd = $_POST['idPegawaiTtd'];


    $sqlPegawai = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = $nip");
    $fetchPegawai = mysqli_fetch_array($sqlPegawai);

    $namaPegawai = $fetchPegawai['nama_pegawai'];
    $pegawaiIdBidang = $fetchPegawai['id_bidang'];
    $pegawaiIdPangkatGol = $fetchPegawai['id_pangkat_gol'];
    $pegawaiIdJabatan = $fetchPegawai['id_jabatan'];
    $pegawaiIdJabatanJenis = $fetchPegawai['id_jabatan_jenis'];

    // Query Ambil Data Bidang Pegawai
    $sqlBidangPegawai = mysqli_query($conn, "SELECT * FROM tb_bidang where id_bidang = $pegawaiIdBidang");
    $fetchBidang = mysqli_fetch_array($sqlBidangPegawai);
    $namaBidangPegawai = $fetchBidang['nama_bidang'];

    // Query Ambil Data Pangkat Golongan Pegawai
    $sqlPangkatGolPegawai = mysqli_query($conn, "SELECT * FROM tb_pangkat_golongan where id_pangkat_golongan = $pegawaiIdPangkatGol");
    $fetchpangkatGol = mysqli_fetch_array($sqlPangkatGolPegawai);
    $pangkatPegawai = $fetchpangkatGol['pangkat'];
    $golonganPegawai = $fetchpangkatGol['golongan'];
    $ruangPegawai = $fetchpangkatGol['ruang'];

    // Query Ambil Data Jabatan Pegawai
    $sqlJabatanPegawai = mysqli_query($conn, "SELECT * FROM tb_jabatan where id_jabatan = $pegawaiIdJabatan");
    $fetchJabatan = mysqli_fetch_array($sqlJabatanPegawai);
    $jabatanPegawai = $fetchJabatan['jabatan_nama'];




    // Ambil Data Atasan
    $sqlTtdPegawai = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = $nipPegawaiTtd");
    $fetchTtdPegawai = mysqli_fetch_array($sqlTtdPegawai);

    $namaPegawaiTtd = $fetchTtdPegawai['nama_pegawai'];
    $idPangkatGolTtdPegawai = $fetchTtdPegawai['id_pangkat_gol'];
    $idjabatanTtdPegawai = $fetchTtdPegawai['id_jabatan'];
    $idBidangTtdPegawai = $fetchTtdPegawai['id_bidang'];



    $sqlJabatanTtdpegawai = mysqli_query($conn, "SELECT * FROM tb_jabatan where id_jabatan = $idjabatanTtdPegawai");
    $fetchJabatanTtdpegawai = mysqli_fetch_array($sqlJabatanTtdpegawai);
    $jabatanTtd = $fetchJabatanTtdpegawai['jabatan_nama'];

    $sqlPangtakGolTtd = mysqli_query($conn, "SELECT * FROM tb_pangkat_golongan where id_pangkat_golongan = $idPangkatGolTtdPegawai");
    $fetchPangkatGolTtd = mysqli_fetch_array($sqlPangtakGolTtd);

    $pangkatTtd = $fetchPangkatGolTtd['pangkat'];
    $GolonganTtd = $fetchPangkatGolTtd['golongan'];
    $ruangTtd = $fetchPangkatGolTtd['ruang'];
    $ttdPegawaiTtd = mysqli_query($conn, "SELECT * FROM tb_ttd where id_pegawai = $nipPegawaiTtd");
    $fetchttdPegawaittd = mysqli_fetch_array($ttdPegawaiTtd);
    if ($fetchttdPegawaittd == null){
        $file = "blank.jpg";
    } else {
        $file = $fetchttdPegawaittd['file_ttd'];
    }
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
        margin: 0;
        padding: 0;
        margin: 3cm;
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
    .centering {
        text-align: center;
        letter-spacing: 1px;
        line-height: 14px;

    }
</style>

</head>
<body>
<div class="container">
<div class="header">
<div class="table-container">
    <table class="table table-top">
        <tr>
            <td style=""><img src="images/logo-jatim.png" alt="" style="margin-right: 20px; width: 80px; " ></td>
            <td class="centering">
                <h2 style="font-weight: 500; " >FORMULIR PENGAJUAN IJIN</h2>
                <h2 style="font-size: 14px; font-weight: bold;">DINAS KOMUNIKASI DAN INFORMATIKA PROVINSI JAWA TIMUR</h2>
                <h2 style="font-weight: 500;">Alamat : Jl. A. Yani No. 242-244 Surabaya Telp. (031) 8294608 Fax. (031) 8294517</h2>
                <h2 style="font-weight: 500;">Website : kominfo.jatimprov.go.id</h2>
                <h2 style="font-weight: 500;">Email : kominfo@jatimprov.go.id</h2>
                <h2 style="font-weight: bold;"><b><u>SURABAYA 60235</u></b></h2>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <h2 style="font-weight: bold; margin: 0; letter-spacing"><b><u>SURAT PERNYATAAN</u></b></h2>
    <p style=" text-align: center; margin: 0;">Nomor: 800/1754/114.1/2023</b></p>
    <br>
    <br>
    <p>Saya yang bertanda tangan di bawah ini : </p>
    <table class="table">
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>' . $namaPegawaiTtd . '</td>
    </tr>
    <tr>
        <td>NIP</td>
        <td>:</td>
        <td>' . $nipPegawaiTtd . '</td>
    </tr>
    <tr>
        <td>Pangkat / Gol Ruang</td>
        <td>:</td>
        <td>' . $pangkatTtd . ' / ' . $golonganTtd . '-' . $ruangTtd . '</td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>' . $jabatanTtd . '</td>
    </tr>
    <tr>
        <td>Unit Kerja</td>
        <td>:</td>
        <td>Dinas Komunikasi dan Informatika Provinsi Jawa Timur</td>
    </tr>
</table>
<p>Menyatakan dengan sebenarnya bahwa Aparatur Sipil Negara (ASN) tersebut di bawah ini :
</p>

    <table class="table">
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>' . $namaPegawai . '</td>
    </tr>
    <tr>
        <td>NIP</td>
        <td>:</td>
        <td>' . $nip . '</td>
    </tr>
    <tr>
        <td>Pangkat / Gol Ruang</td>
        <td>:</td>
        <td>' . $pangkatPegawai . ' / ' . $golonganPegawai . '-' . $ruangPegawai . '</td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>' . $jabatanPegawai . '</td>
    </tr>
    <tr>
        <td>Unit Kerja</td>
        <td>:</td>
        <td>Dinas Komunikasi dan Informatika Provinsi Jawa Timur</td>
    </tr>
</table>
    
</div>
    <p>Pada tanggal ' . $tanggalLupaAbsen . ' yang bersangkutan masuk kerja dan melaksanakan tugas di Dinas Komunikasi dan Informatika Provinsi Jawa Timur sesuai jam kerja. <br><br>
    Demikian Surat Keterangan ini untuk dipergunakan sebagai kelengkapan JATIM PRESENSI. 
    </p>
    <br>

    <table class="table-bot" style="margin-right: 10px; display: flex; justify-content: end;">
    <tr
        style="display: flex; justify-content: flex-end; align-items: right; text-align: right">
        <td
            style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
            <p style="text-align: right;">
                Surabaya, 17 Juli 2023
            </p>
            <br>
            <img src="images/ttd/'.$file.'"
                style="width: 100px;" alt srcset>
            <p><b><u>' . $namaPegawaiTtd . '</u></b></p>
            <p>' . $pangkatTtd . '</p>
            <p>NIP. ' . $nipPegawaiTtd . '</p>
        </td>
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
