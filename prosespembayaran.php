    <?php
        include_once("database.php");
            $id = $_POST['id_warga'];
            $namawarga = $_POST['nama_warga'];
            $tanggalpembayaran = $_POST['tanggal_pembayaran'];
            $statuspembayaran = $_POST['status_pembayaran'];
            // $buktipembayaran = $_POST['bukti_pembayaran'];
            $buktipembayaran = upload_file();
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
            // Mendapatkan nilai dari formulir dan mengamankan datanya
            // $hasil = upload_file();
            // if (!$hasil) {
            //     return false;
            // }

            // Mengeksekusi query
            // mysqli_query($db, $query);



            // Fungsi Upload File
            function upload_file()
            {
                $namaFile   = $_FILES['bukti_pembayaran']['name'];
                $ukuranFile = $_FILES['bukti_pembayaran']['size'];
                $error      = $_FILES['bukti_pembayaran']['error'];
                $tmpName    = $_FILES['bukti_pembayaran']['tmp_name'];

                // Cek Apakah Tidak Ada Gambar yang di Upload
                if( $error === 4){
                    echo "<script>
                            alert('Pilih Gambar Terlebih Dahulu');
                            document.location.href = 'pembayaran.php';
                        </script>";
                }

                // Cek File Yang Di Upload
                $extensibuktipembayaranValid = ['jpg', 'jpeg', 'png'];
                $extensibuktipembayaran      = explode('.', $namaFile);
                $extensibuktipembayaran      = strtolower(end($extensibuktipembayaran));

                if(!in_array($extensibuktipembayaran, $extensibuktipembayaranValid)){
                    
                    // Pesan Gagal
                    echo "<script>
                            alert('Format Tidak Valid');
                            document.location.href = 'pembayaran.php';
                        </script>";
                    die();
                }

                // Cek Ukuran File (5 MB)
                if($ukuranFile > 5000000){
                    echo "<script>
                            alert('Ukuran File Max 5 MB');
                            document.location.href = 'dashboardadmin1.php';
                        </script>";
                    die();
                }

                //Generate Nama File Baru
                $namafileBaru = uniqid();
                $namafileBaru .= '.';
                $namafileBaru .= $extensibuktipembayaran;

                // Pindahkan ke folder lokal
                move_uploaded_file($tmpName, 'images/'. $namafileBaru);
                return $namafileBaru;
            }
            $query = "INSERT INTO tb_pembayaran (id_warga, nama_warga, tanggal_pembayaran, status_pembayaran, bukti_pembayaran, jumlah_pembayaran) VALUES ('$id', '$namawarga', '$tanggalpembayaran', '$statuspembayaran', '$buktipembayaran', '$jumlahpembayaran')";
            $hasil = mysqli_query($db, $query);

            if ($hasil) {
                header('location:tablespembayaranadmin2.php');
            } else {
                echo "input data gagal";
            }
            // Testing 1 (End)

                
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

                // include_once("database.php");

                // // Fungsi untuk mengeksekusi query dan mengambil hasilnya
                // function query($query)
                // {
                //     global $db;
                //     $result = mysqli_query($db, $query);
                //     $data = [];
                //     while ($data = mysqli_fetch_assoc($result)) {
                //         $data[] = $data;
                //     }
                //     return $data;
                // }
                
                // // Fungsi untuk menambahkan data project ke dalam database
                // function tambah($data)
                // {
                //     global $db;
                
                //     // Mendapatkan nilai dari formulir dan mengamankan datanya
                //     $namawarga = htmlspecialchars($data["nama_warga"]);
                //     $tanggalpembayaran = htmlspecialchars($data["tanggal_pembayaran"]);
                //     $statuspembayaran = htmlspecialchars($data["status_pembayaran"]);
                //     $jumlahpembayaran = htmlspecialchars($data["jumlah_pembayaran"]);
                
                //     // Mengunggah file gambar dan menyimpannya di server
                //     $buktipembayaran = upload_file();
                //     if (!$buktipembayaran) {
                //         return false;
                //     }
                
                //     // Membuat query SQL untuk menambahkan data project ke dalam database
                //     $query = "INSERT INTO tb_pembayaran VALUES 
                //             ('', '$namawarga', '$tanggalpembayaran', '$statuspembayaran', '$jumlahpembayaran', '$buktipembayaran')";
                
                //     // Mengeksekusi query
                //     mysqli_query($db, $query);
                
                //     // Mengembalikan jumlah baris yang terpengaruh oleh operasi SQL
                //     return mysqli_affected_rows($db);
                // }
                

                // // Testing 4 (Start)
                // // Fungsi untuk mengelola proses pengunggahan file gambar
                // function upload_file()
                // {
                //     // Mendapatkan informasi tentang file gambar yang diunggah
                //     $namafile = $_FILES['bukti_pembayaran']['name'];
                //     $ukuranfile = $_FILES['bukti_pembayaran']['size'];
                //     $error = $_FILES['bukti_pembayaran']['error'];
                //     $tmpName = $_FILES['bukti_pembayaran']['tmp_name'];
                
                //     // Cek apakah file gambar diunggah dengan benar
                //     if ($error === 4) {
                //         echo "<script>
                //                 alert('Pilih gambar terlebih dahulu');
                //                 document.location.href = 'pembayaran.php';
                //         </script>";
                //         return false;
                //     }
                
                //     // Cek apakah yang diunggah adalah file gambar yang valid
                //     $buktipembayaranValid = ['jpg', 'jpeg', 'png'];
                //     $buktipembayaran = explode('.', $namafile);
                //     $buktipembayaran = strtolower(end($buktipembayaran));
                //     if (!in_array($buktipembayaran, $buktipembayaranValid)) {
                //         echo "<script>
                //                 alert('Yang Anda unggah bukan gambar');
                //                 document.location.href = 'pembayaran.php';
                //         </script>";
                //         return false;
                //     }
                
                //     // Cek apakah ukuran file gambar tidak terlalu besar
                //     if ($ukuranfile > 1000000) {
                //         echo "<script>
                //                 alert('Ukuran gambar terlalu besar');
                //                 document.location.href = 'pembayaran.php';
                //         </script>";
                //         return false;
                //     }
                
                //     // Menghasilkan nama file gambar baru dan menyimpannya di server
                //     $namafileBaru = uniqid();
                //     $namafileBaru .= '.';
                //     $namafileBaru .= $buktipembayaran;
                
                //     move_uploaded_file($tmpName, 'images/' . $namafileBaru);
                //     return $namafileBaru;
                // }
                
                // if ($result) {
                //     header('location:tablespembayaranadmin2.php');
                // } else {
                //     echo "input data gagal";
                // }
                // // Testing 4 (End)


        //         // Testing 5 (Start)
        //         // Proses upload bukti pembayaran
        //         include_once("database.php");

        //         if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //             if (isset($_POST['id_warga'], $_POST['nama_warga'], $_POST['tanggal_pembayaran'], $_POST['status_pembayaran'], $_POST['jumlah_pembayaran']) && !empty($_FILES["bukti_pembayaran"]["name"])) {
        //                 $id = $_POST['id_warga'];
        //                 $namawarga = $_POST['nama_warga'];
        //                 $tanggalpembayaran = $_POST['tanggal_pembayaran'];
        //                 $statuspembayaran = $_POST['status_pembayaran'];
        //                 $jumlahpembayaran = $_POST['jumlah_pembayaran'];

        //         $target_dir = "images/";
        //         $target_file = $target_dir . basename($_FILES["bukti_pembayaran"]["name"]);
        //         $uploadOk = 1;
        //         $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //         // Periksa apakah file adalah gambar asli atau bukan
        //         $check = getimagesize($_FILES["bukti_pembayaran"]["tmp_name"]);
        //         if ($check !== false) {
        //             $uploadOk = 1;
        //         } else {
        //             echo "Bukan file gambar";
        //             $uploadOk = 0;
        //         }

        //         // Periksa ukuran file
        //         if ($_FILES["bukti_pembayaran"]["size"] > 500000) {
        //             echo "Ukuran file terlalu besar";
        //             $uploadOk = 0;
        //         }

        //         // Periksa jenis file
        //         if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        //             echo "Format file harus JPG, JPEG, PNG & GIF";
        //             $uploadOk = 0;
        //         }

        //         // Periksa apakah uploadOk bernilai 0 karena kesalahan
        //         if ($uploadOk == 0) {
        //             echo "File tidak bisa diupload";
        //         // Jika semua periksa dilalui, coba unggah file
        //         } else {
        //             if (move_uploaded_file($_FILES["bukti_pembayaran"]["tmp_name"], $target_file)) {
        //                 // Ambil id_pembayaran terakhir dan buat id_pembayaran baru
        //                 $query_id = "SELECT MAX(id_warga) AS maxKode FROM tb_pembayaran";
        //                 $hasil_id = mysqli_query($db, $query_id);
        //                 $data_id = mysqli_fetch_array($hasil_id);

        //                 $maxkode = $data_id['maxKode'];
        //                 $nourut = 0;
        //                 if ($maxkode) {
        //                     $nourut = (int) substr($maxkode, 3);
        //                 }

        //                 $nourut++;
        //                 $char = 'BYR';
        //                 $kodejadi = $char . sprintf("%03s", $nourut);

        //                 // Simpan data ke database
        //                 $query = "INSERT INTO tb_pembayaran (id_warga, nama_warga, tanggal_pembayaran, status_pembayaran, bukti_pembayaran, jumlah pembayaran) 
        //                         VALUES ('$id', '$namawarga', '$tanggalpembayaran', '$statuspembayaran', '$buktipembayaran', '$jumlahpembayaran')";

        //                 if (mysqli_query($db, $query)) {
        //                     echo "<script>
        //                             alert('Pembayaran berhasil disimpan');
        //                             document.location.href = 'tablespembayaranadmin2.php';
        //                         </script>";
        //                 } else {
        //                     echo "Error: " . $query . "<br>" . mysqli_error($db);
        //                 }
        //             } else {
        //                 echo "Terjadi kesalahan saat upload";
        //             }
        //         }
        //     } 
        //     // else {
        //     //     echo "Data tidak lengkap atau file tidak diunggah.";
        //     // }
        // }
        //         // Testing 5 (End)
    ?>