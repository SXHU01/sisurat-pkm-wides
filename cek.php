<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';


session_start();

$nip = $_SESSION['sess_nip'];

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
$golongan = $fetch_pangkat_gol['pangkat'];
$ruang = $fetch_pangkat_gol['ruang'];

$sql_jabatan = mysqli_query($conn, "SELECT * FROM tb_jabatan where id_jabatan = $id_jabatan");
$fetch_jabatan = mysqli_fetch_array($sql_jabatan);

$jabatan = $fetch_jabatan['jabatan_nama'];




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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container-fluid">
<div class="header">
    <h2 style="font-size: 12px; font">FORMULIR PENGAJUAN IJIN</h2>
    <h2>DINAS KOMUNIKASI DAN INFORMATIKA PROVINSI JAWA TIMUR</h2>
    <h2>TAHUN 2023</h2>
</div>
<div class="table-container">
    <table class="table">
        <tr>
            <td>NAMA</td>
            <td>:</td>
            <td><?= $nama ?></td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td><?= $nip ?></td>
        </tr>
        <tr>
            <td>PANGKAT / GOLONGAN</td>
            <td>:</td>
            <td><?= $pangkat ?> / <?= $golongan ?></td>
        </tr>
        <tr>
            <td>JABATAN</td>
            <td>:</td>
            <td><?= $jabatan ?></td>
        </tr>
        <tr>
            <td>TGL. IJIN </td>
            <td>:</td>
            <td><?= $tanggal_ijin ?></td>
        </tr>
        <tr>
            <td>ALASAN </td>
            <td>:</td>
            <td><?= $alasan ?></td>
        </tr>
        <tr>
            <td>ALAMAT </td>
            <td>:</td>
            <td><?= $alamat ?></td>
        </tr>
        <tr>
            <td>KONTAK PERSON </td>
            <td>:</td>
            <td><?= $no_telp ?></td>
        </tr>
    </table>
</div>

<div class="table-container">
    <table class="table">
        <tr>
            <td colspan="2" style="text-align: right">Surabaya, <?= $tanggal ?></td>
        </tr>
        <tr style="text-align: center;">
            <td>Mengetahui: <br> Atasan Langsung</td>
            <td>Pengaju Ijin</td>
        </tr>
        <tr style="text-align: center;">
            <td style="margin: 0;"><img src="../images/ttd/ttd.png" alt=""></td>
            <td></td>
        </tr>
        <tr style="text-align: center;">
            <td>RATNA DYAH AYUNINGTYAS, S.E. <br> NIP. 198002242010012009</td>
            <td><?= $nama ?> <br> NIP: <?= $nip ?></td>
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
$mpdf->Output();
?>