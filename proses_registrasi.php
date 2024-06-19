<?php
// include("database.php");

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     // Ambil data dari form
//     $username = mysqli_real_escape_string($db, $_POST['username']);
//     $password = mysqli_real_escape_string($db, $_POST['password']);

//     // Query untuk memasukkan data ke tabel users
//     $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

//     if (mysqli_query($db, $query)) {
//         echo "Penginputan berhasil";
//     } else {
//         echo "Error: " . mysqli_error($db);
//     }

//     // Tutup koneksi
//     mysqli_close($db);
// }

include_once("database.php");

    if(isset($_POST["register"])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordconfirm = $_POST['password_confirm'];
        $role = $_POST['role'];
        // $tanggalpengeluaran = $_POST['tanggal_pengeluaran'];

        $query = "INSERT INTO users (username, password, password_confirm, role) VALUES ('$username', '$password', '$passwordconfirm', '$role')";
        $hasil = mysqli_query($db, $query);

        if ($hasil) {
            header('location:login.php');
        } else {
            echo "input data gagal";
        }
    }
?>
