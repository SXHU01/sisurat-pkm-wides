<?php

use Mpdf\Tag\Br;

        include 'koneksi.php';

        $nip = $_POST['nip'];
        $nama_pegawai = $_POST['nama_pegawai'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jabatan = $_POST['jabatan'];
        $pangkat_golongan = $_POST['pangkat_golongan'];
        $bidang = $_POST['pangkat_golongan'];
        $tmt_jabatan = $_POST['tmt_jabatan'];
        $tmt_pensiun = $_POST['tmt_pensiun'];



        if (empty($nip)|| empty($nama_pegawai) || empty($jabatan) || empty($pangkat_golongan)) {
            echo "Data tidak lengkap!";
            echo "<Br>";
            echo "WAJIB ISI = NIP, Nama, Jabatan, Pangkat Golongan";
        } else {
            $sql = "INSERT INTO tb_pegawai (id_pegawai, nip, nama_pegawai, tempat_lahir, tgl_lahir, id_jabatan, id_pangkat_gol, id_bidang, tmt_jabatan, tmt_pensiun)
                     VALUES ('$nip','$nip','$nama_pegawai','$tempat_lahir','$tanggal_lahir','$jabatan','$pangkat_golongan','$bidang','$tmt_jabatan','$tmt_pensiun')";
            if (mysqli_query($conn, $sql)) {
                echo "Pendaftaran berhasil!";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }

            mysqli_close($conn); 
?>