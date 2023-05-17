<?php
$host = "localhost"; // sesuaikan dengan host Anda
$user = "root"; // sesuaikan dengan username Anda
$pass = ""; // sesuaikan dengan password Anda
$dbname = "db_absensi";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
?>
