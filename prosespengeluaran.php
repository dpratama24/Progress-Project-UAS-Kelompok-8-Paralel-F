<?php
    include_once("database.php");
        $id = $_POST['id_pengeluaran'];
        $jumlahpengeluaran = $_POST['jumlah_pengeluaran'];
        $saldo = $_POST['saldo'];
        $tanggalpengeluaran = $_POST['tanggal_pengeluaran'];

        $query = "INSERT INTO tb_pengeluaran (id_pengeluaran, jumlah_pengeluaran, saldo, tanggal_pengeluaran) VALUES ('$id', '$jumlahpengeluaran', '$saldo', '$tanggalpengeluaran')";
        $hasil = mysqli_query($db, $query);

        if ($hasil) {
            header('location:tablespengeluaranadmin1.php');
        } else {
            echo "input data gagal";
        }

        
?>