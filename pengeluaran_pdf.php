<?php
require('./fpdf/fpdf.php');
include 'database.php';

$query= "SELECT * FROM tb_pengeluaran";
$hasil= mysqli_query ($db, $query);
$rp = "Rp. ";

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
 
// Instance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(280, 10, 'DATA PENGELUARAN', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);
if (!empty($periode)) {
    $pdf->Cell(280, 10, 'Periode: ' . $periode, 0, 1, 'C');
}

$pdf->Cell(10, 15, '', 0, 1);

$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO.', 1, 0, 'C');
$pdf->Cell(75, 7, 'JUMLAH PNGELUARAN', 1, 0, 'C');
$pdf->Cell(64, 7, 'KETERANGAN PENGELUARAN', 1, 0, 'C');
$pdf->Cell(64, 7, 'JENIS PENGELUARAN', 1, 0, 'C');
$pdf->Cell(64, 7, 'TANGGAL PENGELUARAN', 1, 1, 'C');

$pdf->SetFont('Times', '', 10);
$no = 1;
$query = "SELECT * FROM tb_pengeluaran";

if (!empty($startDate) && !empty($endDate)) {
    $query .= " WHERE tanggal_pengeluaran BETWEEN '$startDate' AND '$endDate'";
}

$query .= " ORDER BY id_pengeluaran DESC"; // Urutan berdasarkan id_warga secara descending

$data = mysqli_query($db, $query);
while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(75, 6, $rp. $d['jumlah_pengeluaran'], 1, 0, "C");
    $pdf->Cell(64, 6, $d['keterangan_pengeluaran'], 1, 0, "C");
    $pdf->Cell(64, 6, $d['jenis_pengeluaran'], 1, 0, "C");
    $pdf->Cell(64, 6, $d['tanggal_pengeluaran'], 1, 1, "C");
}

$pdf->Output('I', 'Laporan_Pengeluaran.pdf');
?>