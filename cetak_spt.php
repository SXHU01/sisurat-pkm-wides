<?php
    include "admin/koneksi.php";
    if (isset($_POST['cetakSurat'])) {
        $codeSurat = $_POST['id_spt'];
        $id_ttd = $_POST['ttd'];
        $sql = mysqli_query($conn, "UPDATE tb_spt_pegawai SET id_ttd = $id_ttd where code_surat = '$codeSurat'");
        if ($sql){
            header("location: proses_spt.php?code=$codeSurat");
        }
    }
