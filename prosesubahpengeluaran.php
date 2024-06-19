<?php
    include_once("database.php");
    $id= $_POST['id_pengeluaran'];
    $jumlahpengeluaran = $_POST['jumlah_pengeluaran'];
    $keteranganpengeluaran= $_POST['keterangan pengeluaran'];
    $jenispengeluaran= $_POST['jenis_pengeluaran'];
    $tanggalpengeluaran= $_POST['tanggal_pengeluaran'];

    $query="UPDATE tb_pengeluaran SET jumlah_pengeluaran='$jumlahpengeluaran', keterangan_pengeluaran='$keteranganpengeluaran', jenis_pengeluaran='$jenispengeluaran', tanggal_pengeluaran='$tanggalpengeluaran' WHERE id_pengeluaran='$id'";
    $hasil=mysqli_query($db,$query);
    
    if ($hasil) {
        header('location:tablespengeluaraadmin1.php');
    } else {
        echo "Update data gagal";
    }
?>