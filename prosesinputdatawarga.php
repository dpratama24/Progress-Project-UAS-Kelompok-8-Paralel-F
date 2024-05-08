<?php
    include_once("database.php");
        $id = $_POST['id_warga'];
        $namawarga = $_POST['nama_warga'];
        $jeniskelamin = $_POST['jenis_kelamin'];
        $pekerjaan = $_POST['pekerjaan'];
        $notelpon = $_POST['no_telpon'];
        $email = $_POST['email'];

        $query = "INSERT INTO tb_datawarga (id_warga, nama_warga, jenis_kelamin, pekerjaan, no_telpon, email) VALUES ('$id', '$namawarga', '$jeniskelamin', '$pekerjaan', '$notelpon', '$email')";
        $hasil = mysqli_query($db, $query);

        if ($hasil) {
            header('location:datawargaadmin1.php');
        } else {
            echo "input data gagal";
        }     

?>