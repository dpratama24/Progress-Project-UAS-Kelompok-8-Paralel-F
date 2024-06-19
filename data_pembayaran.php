<?php
    include "database.php";

    $functionName = htmlspecialchars($_GET['functionName']);

    switch ($functionName){
        case 'getDataPembayaran':
            getDataPembayaran();
            break;
            
            // case 'getDataLainnya':
            //     getDataLainnya();
            //     break;
        
            default:
                # code...
                break;
    }
    function getDataPembayaran()
    {
        global $conn;

        $data = [];
        $query = mysqli_query($conn, "SELECT * FROM tb_pembayaran");

        while($row = mysqli_fetch_assoc($query)){
            $data[]= $row;
        }

        echo json_encode($data);
    }
?>