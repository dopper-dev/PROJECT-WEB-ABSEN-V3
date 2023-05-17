<?php
session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  // buat koneksi ke database
  $host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "db_absensi";
  
  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // buat query SQL untuk mengambil nama_pengguna dari tabel users_db
    $stmt = $pdo->prepare("SELECT nama_pengguna FROM users_db WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    // simpan hasil query ke dalam variabel $username
    $username = $stmt->fetchColumn();

    // kembalikan hasil sebagai teks
    echo $username;
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  $pdo = null;
} else {
  echo "";
}
?>
