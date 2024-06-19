<?php
    include_once ("database.php");
    $id=$_GET['id'];
    $query="DELETE FROM tb_pengeluaran WHERE id_pengeluaran='$id'";
    $hasil=mysqli_query($db,$query);
    
    if ($hasil) {
        header('location:tablespengeluaranadmin1.php');
    }else {
        echo "Hapus Data Gagal";
    }
?>