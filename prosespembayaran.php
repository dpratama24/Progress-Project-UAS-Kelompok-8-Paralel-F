<?php
    include_once("database.php");
        $id = $_POST['id_warga'];
        $namawarga = $_POST['nama_warga'];
        $tanggalpembayaran = $_POST['tanggal_pembayaran'];
        $statuspembayaran = $_POST['status_pembayaran'];
        $buktipembayaran = $_POST['bukti_pembayaran'];
        // $buktipembayaran = upload_file();
        $jumlahpembayaran = $_POST['jumlah_pembayaran'];
        // $buktipembayaran = $_FILES['bukti_pembayaran']['name'];

        // $query_id = "SELECT max(id_buku) as maxKode FROM tb_buku";
        // $hasil_id = mysqli_query($conn, $query_id);
        // $data_id = mysqli_fetch_array($hasil_id);

        // $maxkode = $data_id['maxKode'];
        // $nourut = (int) substr($maxkode, 2, 3);

        // $nourut++;
        // $char = 'ID';
        // $kodejadi = $char . sprintf("%03s", $nourut);


        // Testing 1 (Start)
        $query = "INSERT INTO tb_pembayaran (id_warga, nama_warga, tanggal_pembayaran, status_pembayaran, bukti_pembayaran, jumlah_pembayaran) VALUES ('$id', '$namawarga', '$tanggalpembayaran', '$statuspembayaran', '$buktipembayaran', '$jumlahpembayaran')";
        $hasil = mysqli_query($db, $query);

        if ($hasil) {
            header('location:tablespembayaranadmin2.php');
        } else {
            echo "input data gagal";
        }

        // // Fungsi Upload File
        // function upload_file()
        // {
        //     $namaFile   = $_FILES['bukti_pembayaran']['name'];
        //     $ukuranFile = $_FILES['bukti_pembayaran']['size'];
        //     $error      = $_FILES['bukti_pembayaran']['error'];
        //     $tmpName    = $_FILES['bukti_pembayaran']['tmp_name'];

        //     // Cek Apakah Tidak Ada Gambar yang di Upload
        //     if( $error === 4){
        //         echo "<script>
        //                 alert('Pilih Gambar Terlebih Dahulu');
        //                 document.location.href = 'pembayaran.php';
        //               </script>";
        //     }

        //     // Cek File Yang Di Upload
        //     $extensibuktipembayaranValid = ['jpg', 'jpeg', 'png'];
        //     $extensibuktipembayaran      = explode('.', $namaFile);
        //     $extensibuktipembayaran      = strtolower(end($extensibuktipembayaran));

        //     if(!in_array($extensibuktipembayaran, $extensibuktipembayaranValid)){
                
        //         // Pesan Gagal
        //         echo "<script>
        //                 alert('Format Tidak Valid');
        //                 document.location.href = 'pembayaran.php';
        //               </script>";
        //         die();
        //     }

        //     // Cek Ukuran File (5 MB)
        //     if($ukuranFile > 5000000){
        //         echo "<script>
        //                 alert('Ukuran File Max 5 MB');
        //                 document.location.href = 'dashboardadmin1.php';
        //               </script>";
        //         die();
        //     }

        //     //Generate Nama File Baru
        //     $namafileBaru = uniqid();
        //     $namafileBaru .= '.';
        //     $namafileBaru .= $extensibuktipembayaran;

        //     // Pindahkan ke folder lokal
        //     move_uploaded_file($tmpName, 'gambar/'. $namafileBaru);
        //     return $namafileBaru;
        // }
        // // Testing 1 (End)

            
            // // Testing 2 (Start)
            // if($buktipembayaran != ""){
            //     $ekstensi_diperbolehkan = array('jpg', 'jpeg', 'png');
            //     $x = explode('.', $buktipembayaran);
            //     $ekstensi = strtolower(end($x));
            //     $file_tmp = $_FILES['bukti_pembayaran']['tmp_name'];
            //     $angka_acak = rand(1, 999);
            //     $bukti_pembayaran_baru = $angka_acak. '-'. $buktipembayaran;

            //     if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            //         move_uploaded_file($file_tmp, 'images/'. $bukti_pembayaran_baru);

            //         $query = "INSERT INTO tb_pembayaran (id_warga, nama_warga, tanggal_pembayaran, status_pembayaran, bukti_pembayaran, jumlah_pembayaran) VALUES ('$id', '$namawarga', '$tanggalpembayaran', '$statuspembayaran', '$bukti_pembayaran_baru', '$jumlahpembayaran')";
            //         $hasil = mysqli_query($db, $query);

            //         if(!$hasil){
            //             die("Querry Error : ".mysqli_errno($db)." - ".mysqli_error($db));

            //         }else {
            //             echo "<script>alert('Data Berhasil Ditambahkan');window.location='tablespembayaranadmin2.php';</script>";
            //         }

            //         }else {
            //             echo "<script>alert('Ekstensi Gambar Hanya JPG, JPEG, PNG');window.location='pembayaran.php';</script>"; 
            //         }

            //     }else {

            //         $query = "INSERT INTO tb_pembayaran (id_warga, nama_warga, tanggal_pembayaran, status_pembayaran, jumlah_pembayaran) VALUES ('$id', '$namawarga', '$tanggalpembayaran', '$statuspembayaran', '$jumlahpembayaran')";
            //         $hasil = mysqli_query($db, $query);

            //             if(!$hasil){
            //                 die("Querry Error : ".mysqli_errno($db)." - ".mysqli_error($db));
            //             }else {
            //                 echo "<script>alert('Data Berhasil Ditambahkan');window.location='tablespembayaranadmin2.php';</script>";
            //             }

            //     }
            //     //Testing 2 (End)

            
            // //Testing 3 (Start)
            // if(isset($_POST["submit"])){
            //     // Periksa apakah terdapat file yang diunggah
            //     if(isset($_FILES["bukti_pembayaran"]) && $_FILES["bukti_pembayaran"]["error"] == 0){
            //         $target_dir = "gambar/"; // Folder tujuan untuk menyimpan gambar
            //         $target_file = $target_dir . basename($_FILES["bukti_pembayaran"]["name"]); // Path lengkap file tujuan
            
            //         // Periksa apakah tipe file diizinkan
            //         $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            //         if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            //             echo "Hanya file JPG, JPEG, dan PNG yang diizinkan.";
            //         } else {
            //             // Coba pindahkan file ke lokasi tujuan
            //             if(move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)){
            //                 echo "File berhasil diunggah.";
            //             } else {
            //                 echo "Terjadi kesalahan saat mengunggah file.";
            //             }
            //         }
            //     } else {
            //         echo "Mohon pilih file gambar untuk diunggah.";
            //     }
            // }
            // //Testing 3 (End)

?>