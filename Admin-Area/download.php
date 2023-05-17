<?php
	
  session_start();
  if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

if(isset($_SESSION['pesan_success']));

	include "koneksi.php";
	/*
	if(isset($_session['id'])){
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';	
	}*/		
	$admin_id = $_SESSION['admin_id'];
	
	
?>

<?php
require_once('tfpdf/tfpdf.php');

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_absensi');

// Query untuk mengambil data mahasiswa
$sql = "SELECT * FROM users";

// Eksekusi query
$result = mysqli_query($conn, $sql);

// Membuat objek PDF
$pdf = new tFPDF();
$pdf->AddPage('L', 'A3'); // ubah lebar halaman menjadi landscape dan ukuran A3
$pdf->SetAutoPageBreak(true, 20);

// Menambahkan judul pada halaman PDF
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Data Absensi Mahasiswa',0,1,'C');
$pdf->Ln();

// Menambahkan header tabel
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,'NPM',1,0,'C');
$pdf->Cell(80,10,'Nama',1,0,'C'); // ubah lebar kolom menjadi 80
$pdf->Cell(60,10,'Email',1,0,'C'); // ubah lebar kolom menjadi 60
$pdf->Cell(60,10,'Mata Kuliah',1,0,'C'); // ubah lebar kolom menjadi 60
$pdf->Cell(30,10,'Kehadiran',1,0,'C'); // ubah lebar kolom menjadi 30
$pdf->Cell(30,10,'Pertemuan',1,0,'C'); // ubah lebar kolom menjadi 30
$pdf->Cell(40,10,'Semester',1,0,'C'); // ubah lebar kolom menjadi 40
$pdf->Cell(65,10,'Waktu Absen',1,1,'C'); // ubah lebar kolom menjadi 70

// Menambahkan data mahasiswa ke dalam tabel
$pdf->SetFont('Arial','',10);
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(40,10,$row['npm'],1,0,'C');
    $pdf->Cell(80,10,$row['nama'],1,0,'L');
    $pdf->Cell(60,10,$row['email'],1,0,'L');
    $pdf->Cell(60,10,$row['matkul'],1,0,'L');
    $pdf->Cell(30,10,$row['kehadiran'],1,0,'C');
    $pdf->Cell(30,10,$row['pertemuan'],1,0,'C');
    $pdf->Cell(40,10,$row['semester'],1,0,'C');
    $pdf->Cell(65,10,$row['waktu_absen'],1,1,'L');
}

// Mengambil waktu saat ini
$current_time = time();

// Menambahkan waktu saat ini pada nama file untuk membuat nama file unik
$file_name = 'data_mahasiswa_' . $current_time . '.pdf';

// Mendownload file PDF
$pdf->Output($file_name, 'D');

// Menutup koneksi ke database
mysqli_close($conn);
?>
