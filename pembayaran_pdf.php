<?php
require('./fpdf/fpdf.php');
include 'database.php';

// Mendapatkan nilai tanggal dari parameter GET jika tersedia
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Mengonversi tanggal ke format bulan dan tahun
$startMonthYear = !empty($startDate) ? date('F Y', strtotime($startDate)) : '';
$endMonthYear = !empty($endDate) ? date('F Y', strtotime($endDate)) : '';
$periode = '';

if (!empty($startMonthYear) && !empty($endMonthYear)) {
    if ($startMonthYear == $endMonthYear) {
        $periode = $startMonthYear; // Periode dalam satu bulan
    } else {
        $periode = $startMonthYear . ' - ' . $endMonthYear; // Periode antar bulan
    }
}

// Membuat instance objek dan mengatur halaman PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(280, 10, 'DATA PEMBAYARAN', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);
if (!empty($periode)) {
    $pdf->Cell(280, 10, 'Periode: ' . $periode, 0, 1, 'C');
}

$pdf->Cell(10, 15, '', 0, 1); // Memberi jarak

$pdf->SetFont('Times', 'B', 9);

$pdf->Cell(10, 7, 'NO.', 1, 0, 'C');
$pdf->Cell(60, 7, 'NAMA', 1, 0, 'C');
$pdf->Cell(45, 7, 'TANGGAL PEMBAYARAN', 1, 0, 'C');
$pdf->Cell(45, 7, 'STATUS PEMBAYARAN', 1, 0, 'C');
$pdf->Cell(65, 7, 'BUKTI PEMBAYARAN', 1, 0, 'C');
$pdf->Cell(50, 7, 'JUMLAH PEMBAYARAN', 1, 1, 'C');

$pdf->SetFont('Times', '', 10);
$no = 1;
$query = "SELECT * FROM tb_pembayaran";

if (!empty($startDate) && !empty($endDate)) {
    $query .= " WHERE tanggal_pembayaran BETWEEN '$startDate' AND '$endDate'";
}

$query .= " ORDER BY id_warga DESC"; // Urutan berdasarkan id_warga secara descending

$data = mysqli_query($db, $query);

while ($d = mysqli_fetch_array($data)) {
    // Set the height of the row based on the maximum cell height (image cell height)
    $cellHeight = 50; // Fixed cell height for consistency

    $pdf->Cell(10, $cellHeight, $no++, 1, 0, 'C');
    $pdf->Cell(60, $cellHeight, $d['nama_warga'], 1, 0);
    $pdf->Cell(45, $cellHeight, $d['tanggal_pembayaran'], 1, 0, "C");
    $pdf->Cell(45, $cellHeight, $d['status_pembayaran'], 1, 0, "C");

    // Menampilkan gambar di dalam sel
    if (!empty($d['bukti_pembayaran']) && file_exists($d['bukti_pembayaran'])) {
        // Mendapatkan dimensi gambar
        list($imgWidth, $imgHeight) = getimagesize($d['bukti_pembayaran']);

        // Menyesuaikan lebar dan tinggi gambar sesuai kebutuhan
        $maxWidth = 65; // Lebar maksimum sel
        $maxHeight = $cellHeight; // Tinggi maksimum sel (sama dengan cell height)
        $aspectRatio = $imgWidth / $imgHeight;

        if ($imgWidth > $maxWidth || $imgHeight > $maxHeight) {
            if ($aspectRatio > 1) {
                $newWidth = $maxWidth;
                $newHeight = $maxWidth / $aspectRatio;
            } else {
                $newHeight = $maxHeight;
                $newWidth = $maxHeight * $aspectRatio;
            }
        } else {
            $newWidth = $imgWidth;
            $newHeight = $imgHeight;
        }

        // Simpan posisi saat ini
        $xPos = $pdf->GetX();
        $yPos = $pdf->GetY();

        // Membuat sel kosong untuk gambar
        $pdf->Cell($maxWidth, $maxHeight, '', 1, 0);

        // Kembali ke posisi awal sel kosong
        $pdf->SetXY($xPos, $yPos);

        // Menampilkan gambar di dalam sel
        $pdf->Image($d['bukti_pembayaran'], $xPos + (($maxWidth - $newWidth) / 2), $yPos + (($maxHeight - $newHeight) / 2), $newWidth, $newHeight);

        // Set posisi X kembali ke setelah cell gambar
        $pdf->SetXY($xPos + $maxWidth, $yPos);
    } else {
        $pdf->Cell(65, $cellHeight, 'Tidak Ada', 1, 0, 'C'); // Jika tidak ada gambar
    }

    // Format jumlah pembayaran dalam Rupiah
    $formattedJumlahPembayaran = 'Rp ' . number_format($d['jumlah_pembayaran'], 0, ',', '.');

    $pdf->Cell(50, $cellHeight, $formattedJumlahPembayaran, 1, 1, "C");
}

$pdf->Output('I', 'Laporan_pertemuan.pdf');
?>
