<?php
include_once("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nama_warga'], $_POST['status_pembayaran'], $_POST['jumlah_pembayaran'], $_POST['tanggal_pembayaran']) && !empty($_FILES["bukti_pembayaran"]["name"])) {
        $nama_warga = $_POST['nama_warga'];
        $status_pembayaran = $_POST['status_pembayaran'];
        $jumlah_pembayaran = $_POST['jumlah_pembayaran'];
        $tanggal_pembayaran = $_POST['tanggal_pembayaran'];

        // Proses upload bukti pembayaran
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["bukti_pembayaran"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Periksa apakah file adalah gambar asli atau bukan
        $check = getimagesize($_FILES["bukti_pembayaran"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Bukan file gambar";
            $uploadOk = 0;
        }

        // Periksa ukuran file
        if ($_FILES["bukti_pembayaran"]["size"] > 500000) {
            echo "Ukuran file terlalu besar";
            $uploadOk = 0;
        }

        // Periksa jenis file
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "Format file harus JPG, JPEG, PNG & GIF";
            $uploadOk = 0;
        }

        // Periksa apakah uploadOk bernilai 0 karena kesalahan
        if ($uploadOk == 0) {
            echo "File tidak bisa diupload";
        // Jika semua periksa dilalui, coba unggah file
        } else {
            if (move_uploaded_file($_FILES["bukti_pembayaran"]["tmp_name"], $target_file)) {
                // Ambil id_pembayaran terakhir dan buat id_pembayaran baru
                // $query_id = "SELECT MAX(id_warga) AS maxKode FROM tb_pembayaran";
                // $hasil_id = mysqli_query($db, $query_id);
                // $data_id = mysqli_fetch_array($hasil_id);

                // $maxkode = $data_id['maxKode'];
                // $nourut = 0;
                // if ($maxkode) {
                //     $nourut = (int) substr($maxkode, 3);
                // }

                // $nourut++;
                // $char = 'BYR';
                // $kodejadi = $char . sprintf("%03s", $nourut);

                $jumlah_pembayaran_rupiah = number_format($jumlah_pembayaran, 0, ',', '.');

                // Simpan data ke database
                $query = "INSERT INTO tb_pembayaran (nama_warga, tanggal_pembayaran, status_pembayaran, bukti_pembayaran, jumlah_pembayaran) 
                          VALUES ('$nama_warga', '$tanggal_pembayaran', '$status_pembayaran', '$target_file', '$jumlah_pembayaran')";

                if (mysqli_query($db, $query)) {
                    echo "<script>
                            alert('Pembayaran berhasil disimpan');
                            document.location.href = 'tablespembayaranadmin2.php';
                          </script>";
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
                }
            } else {
                echo "Terjadi kesalahan saat upload";
            }
        }
    } else {
        echo "Data tidak lengkap atau file tidak diunggah.";
    }
}
?>
