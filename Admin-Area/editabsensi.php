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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Memeriksa apakah npm tersedia dalam parameter URL
  if (isset($_GET['npm'])) {
    $npm = $_GET['npm'];

    // Memeriksa apakah kehadiran terpilih dari form
    if (isset($_POST[$npm])) {
      $kehadiran = $_POST[$npm];

      // Konfigurasi koneksi database
      $host = 'localhost';
      $user = 'root';
      $password = '';
      $dbname = 'db_absensi';

      // Membuat koneksi ke database
      $conn = mysqli_connect($host, $user, $password, $dbname);

      // Mengecek koneksi
      if (!$conn) {
        die('Koneksi database gagal: ' . mysqli_connect_error());
      }

      // Mengupdate data kehadiran berdasarkan npm
      $sql = "UPDATE users SET kehadiran='$kehadiran' WHERE npm='$npm'";
      $query = mysqli_query($conn, $sql);

      if ($query) {
        mysqli_close($conn);
        header("Location: detaileditabsensi.php?npm=$npm&status=success");
        exit();
      } else {
        mysqli_close($conn);
        header("Location: detaileditabsensi.php?npm=$npm&status=gagal");
        exit();
      }
    } else {
      echo "Terjadi kesalahan dalam mendapatkan kehadiran dari form.";
    }
  } else {
    echo "Terjadi kesalahan dalam mendapatkan npm dari URL.";
  }
} else {
  echo "Metode request yang digunakan bukan POST.";
}
?>
