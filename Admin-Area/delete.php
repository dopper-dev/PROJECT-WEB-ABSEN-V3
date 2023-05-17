<?php
	
  session_start();
  if ( !isset($_SESSION["login"]) ) {
    header("Location: ../Sign-In-New");
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

//koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_absensi";
$conn = mysqli_connect($host, $username, $password, $dbname);

//mengecek koneksi ke database
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

//mengambil id data user yang akan dihapus dari query string
$id_user = $_GET['id'];

//menghapus data user dari database dengan prepared statement
$stmt = mysqli_prepare($conn, "DELETE FROM users_db WHERE id = ?");
mysqli_stmt_bind_param($stmt, "s", $id_user);

if (mysqli_stmt_execute($stmt)) {
    //jika data berhasil dihapus, redirect ke halaman utama
    header("Location: ../Admin-Area-New/lihatmhs.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

//menutup koneksi
mysqli_close($conn);

?>
