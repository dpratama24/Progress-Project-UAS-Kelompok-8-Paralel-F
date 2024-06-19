<?php
    include_once("database.php");
        $id = $_POST['id_pengeluaran'];
        $tanggalpengeluaran = $_POST['tanggal_pengeluaran'];
        $keteranganpengeluaran = $_POST['keterangan_pengeluaran'];
        $jenispengeluaran = $_POST['jenis_pengeluaran'];
        $jumlahpengeluaran = $_POST['jumlah_pengeluaran'];

        $query = "INSERT INTO tb_pengeluaran (id_pengeluaran, tanggal_pengeluaran, keterangan_pengeluaran, jenis_pengeluaran, jumlah_pengeluaran) VALUES ('$id', '$tanggalpengeluaran', '$keteranganpengeluaran', '$jenispengeluaran', '$jumlahpengeluaran')";
        $hasil = mysqli_query($db, $query);

        if ($hasil) {
            header('location:tablespengeluaranadmin1.php');
        } else {
            echo "input data gagal";
        }

        
?>
