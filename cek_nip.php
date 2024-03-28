<?php
    include "admin/koneksi.php";

    if (ISSET($_POST['cek_nip'])){

        $nip = $_POST['nip'];
        $sql = mysqli_query($conn, "SELECT * FROM tb_pegawai where id_pegawai = $nip");
        $sql_rows = mysqli_num_rows($sql);


        if($sql_rows >= 1 ){
            session_start();

            $fetch_sql = mysqli_fetch_array($sql);
            $fetch_nip =  $fetch_sql['id_pegawai'];

            $_SESSION['sess_nip'] = $fetch_nip;
            $_SESSION['status'] = "valid";

            header("location: select_letter.php");
        } else {
            header("location: index.php");
        }
    }
?>