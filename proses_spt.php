<?php

setlocale(LC_ALL,
    'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID',
    'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND',
    'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia',
    'id', 'ID',

    // Add english as default (if all Indonesian not available)
    'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English',
);
include "admin/koneksi.php";

if (isset($_GET['code'])) {
    $codeSurat = $_GET['code'];
    $sql = mysqli_query($conn, "SELECT * FROM tb_spt_pegawai where code_surat = '$codeSurat'");
    $fetchSql = mysqli_fetch_array($sql);
    $no_surat = $fetchSql['no_spt'];
    $untuk = $fetchSql['untuk'];
    $tujuan = $fetchSql['tujuan'];
    $alamat = $fetchSql['alamat'];
    $waktu = $fetchSql['waktu'];
    $tanggal = $fetchSql['tanggal_spt'];
    $hari = date("d", strtotime($tanggal));
    $tahun = date("Y", strtotime($tanggal));
    $idPegTtd = $fetchSql['id_ttd'];
    $sqlPersonil = mysqli_query($conn, "SELECT * FROM tb_spt_personil where code_surat = '$codeSurat'");

    switch (date('m', strtotime($tanggal))) {
        case '01':
            $bulan = 'Januari';
            break;
        case '02':
            $bulan = 'Februari';
            break;
        case '03':
            $bulan = 'Maret';
            break;
        case '04':
            $bulan = 'April';
            break;
        case '05':
            $bulan = 'Mei';
            break;
        case '06':
            $bulan = 'Juni';
            break;
        case '07':
            $bulan = 'Juli';
            break;
        case '08':
            $bulan = 'Agustus';
            break;
        case '09':
            $bulan = 'September';
            break;
        case '10':
            $bulan = 'Oktober';
            break;
        case '11':
            $bulan = 'November';
            break;
        case '12':
            $bulan = 'Desember';
            break;
        
        default:
            $bulan = 'Tidak diketahui';
            break;
    }


    // SQL Pegawai kepala
    $sqlPegTtd = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = $idPegTtd");
    $fetchPegTtd = mysqli_fetch_array($sqlPegTtd);



    $namaPegttd = $fetchPegTtd['nama_pegawai'];
    $nipPegttd = $fetchPegTtd['id_pegawai'];
    $idJabatanPegTtd = $fetchPegTtd['id_jabatan'];

    // Sql Ambil Jabatan pegawai Kepala
    $sqlJabatanPegTtd = mysqli_query($conn, "SELECT * FROM tb_jabatan where id_jabatan = $idJabatanPegTtd");
    $fetchJabatanPegTtd = mysqli_fetch_array($sqlJabatanPegTtd);

    $jabatanPegttd = $fetchJabatanPegTtd['jabatan_nama'];

    // 


    // Sql Ambil Dasar Surat
    $sqlDasarSpt = mysqli_query($conn, "SELECT * FROM tb_dasar_spt ORDER BY no_urut ASC");



    // Ambil TTD Pegawai Kepala
    $ttdPegawaiTtd = mysqli_query($conn, "SELECT * FROM tb_ttd where id_pegawai = $nipPegttd");
    $fetchttdPegawaittd = mysqli_fetch_array($ttdPegawaiTtd);

    if ($fetchttdPegawaittd == null) {
        $file = "blank.jpg";
    } else {
        $file = $fetchttdPegawaittd['file_ttd'];
    }

    // var_dump($file);
    // die();
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
<html lang="id, in">
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
    table tr td p {
        line-height: 2.5;
    }
    .table tr td {
        margin: 10px;
        padding: 0;
    }

</style>

    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="table-container">
                    <table class="table table-top">
                        <tr>
                            <td style><img src="images/logo-pkl.jpg" alt
                                 style="margin-right: 5px; width: 60px;">
                            </td>
                            <td class="centering">
                                <h2 style="font-size: 14px; font-weight: bold;">PEMERINTAH KABUPATEN PEKALONGAN<br>
                                    DINAS KESEHATAN<br>
                                    PUSKESMAS WIRADESA
                                </h2>
                                <h2 style="font-weight: 400; font-size: 7px;">
                                    Alamat : Jl.Akhmad Yani Wiradesa Telp.0285 - 4417121 Pekalongan 51152
                                </h2>
                                <h2 style="font-weight: 400; font-size: 7px;">
                                    Email : puskesmas.wiradesa@gmail.com
                                </h2>
                            </td>
                            <td style><img src="images/logo-pusk.jpg" alt
                            style="margin-left: 5px; width: 80px; ">
                            </td>
                        </tr>
                    </table>
                    <hr style="margin: 1;">
                    <hr style="margin: 0;">
                    <br>
                    <br>
                    <h2 style="font-weight: bold; margin: 0; letter-spacing"><b><u>SURAT PERINTAH TUGAS</u></b></h2>
                    <p style="text-align: center; margin: 0;">Nomor:
                        ' . $no_surat . '</b></p>
                <br>

                <div class="container-personil"
                    style="display: flex; flex-direction: row; width: 100%;">
                    <div class="left" style="width: 10%; float: left">
                        <table class="table">
                            <tr>
                                <td>Dasar : </td>
                            </tr>
                        </table>
                    </div>
                    <div class="right" style="width: 90%;">
                        <table class="table">
                        ';
while ($fetchDasar = mysqli_fetch_array($sqlDasarSpt)) {
    $html .= '
                            <tr>
                                <td style="text-align: justify; line-height: 1.5;">
                                ' . $fetchDasar['item_dasar'] . ' 
                                </td>
                            </tr>
                            ';
}
$html .= '
                            
                        </table>
                    </div>
                </div>

                <h2 style="font-weight: 500; margin: 0;">Kepala Puskesmas Wiradesa Menugaskan kepada:</h2>
                <br>
                <br>

                <div class="container-personil"
                    style="display: flex; flex-direction: row; width: 100%;">
                    <div class="left" style="width: 10%; float: left">
                        <table class="table">
                            <tr>
                                <td>Kepada : </td>
                            </tr>
                        </table>
                    </div>
                    <div class="right" style="width: 90%;">
                        <table class="table">
                        ';
$i = 1;
while ($fetchSqlPersonil = mysqli_fetch_array($sqlPersonil)) {
    $id_user = $fetchSqlPersonil['id_user'];
    $sqlPersonilPegawai = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = $id_user");
    $fetchPegawai = mysqli_fetch_array($sqlPersonilPegawai);

    // Mengambil Pangkat/Golongan dari database
    $id_pangkat_golongan = $fetchPegawai['id_pangkat_gol'];
    $sqlPangkatGolongan = mysqli_query($conn, "SELECT * FROM tb_pangkat_golongan where id_pangkat_golongan = $id_pangkat_golongan");
    $fetchPangkatGolongan = mysqli_fetch_array($sqlPangkatGolongan);

    // Mengambil Jabatan dari database
    $id_jabatan = $fetchPegawai['id_jabatan'];
    $sqlJabatan = mysqli_query($conn, "SELECT * FROM tb_jabatan where id_jabatan = $id_jabatan");
    $fetchJabatan = mysqli_fetch_array($sqlJabatan);


    $html .= '
                            <tr>
                                <td>
                                    <table class="table table-nomargin">
                                        <tr>
                                            <td><b> Nama</b></td>
                                            <td><b>:</b></td>
                                            <td><b>' . $fetchPegawai['nama_pegawai'] . ' </b></td>
                                        </tr>
                                        <tr>
                                            <td>NIP</td>
                                            <td>:</td>
                                            <td>' . $fetchPegawai['nip'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Pangkat / Gol</td>
                                            <td>:</td>
                                            <td>' . $fetchPangkatGolongan['pangkat'] . ' / ' . $fetchPangkatGolongan['golongan'] . '-' . $fetchPangkatGolongan['ruang'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td>
                                            <td>:</td>
                                            <td>' .$fetchJabatan['jabatan_nama']. '</td>
                                        </tr>
                                        <tr>
                                            <td>Waktu</td>
                                            <td>:</td>
                                            <td>' . $waktu . '</td>
                                        </tr>
                                        <tr>
                                            <td>Tempat</td>
                                            <td>:</td>
                                            <td>' . $alamat . '</td>
                                        </tr>
                                        <tr>
                                            <td>Keperluan</td>
                                            <td>:</td>
                                            <td>' . $untuk . '</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            ';
    $i++;
}
$html .= '
                          <tr>
                            <td>Demikian surat tugas ini dibuat untuk dipergunakan sebagaimana mestinya.</td>
                          </tr>
                        </table>
                    </div>
                </div>

                <!--<div class="container-personil"
                    style="display: flex; flex-direction: row; width: 100%;">
                    <div class="left" style="width: 10%; float: left">
                        <table class="table">
                            <tr>
                                <td>Untuk : </td>
                            </tr>
                        </table>
                    </div>
                    <div class="right" style="width: 70%;">
                        <table class="table">
                            <tr>
                                <td style
                                    style="text-align: justify; line-height: 2;">' . $untuk . '</td>
                            </tr>
                        </table>
                    </div>
                </div>-->
                <div class="container-ttd" style="width: 100%; display: flex; flex-direction: row;">
                    <div class="left" style="width: 70%;">

                    </div>
                    
                    <div class="right" style="width: 30%; float: right;">
                        <table class="table-bot"
                            style="margin-right: 10px; display: flex; justify-content: end; float: right">
                            <tr
                                style="display: flex; justify-content: flex-end; align-items: right; text-align: right">
                                <td
                                    style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                                    <p style="text-align: right;">
                                        Wiradesa, '.$hari.' '.$bulan.' '.$tahun.'
                                    </p>
                                    <p>' . $jabatanPegttd . ' Puskesmas Wiradesa</p>
                                    <p>Kab. Pekalongan</p>
                                    <br>
                                    <img src="images/ttd/blank.jpg" style="width: 50px;">
                                    <p><b><u>' . $namaPegttd . '</u></b></p>
                                    <p>NIP.' . $nipPegttd . '</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                
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