<?php
session_start();

if (isset($_SESSION['admin_id'])) {
  $admin_id = $_SESSION['admin_id'];

  // buat koneksi ke database
  $host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "db_absensi";
  
  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // buat query SQL untuk mengambil nama_pengguna dari tabel users_db
    $stmt = $pdo->prepare("SELECT nama_pengguna_admin FROM admin WHERE id_admin = :admin_id");
    $stmt->bindParam(':admin_id', $admin_id);
    $stmt->execute();

    // simpan hasil query ke dalam variabel $username
    $email = $stmt->fetchColumn();

    // kembalikan hasil sebagai teks
    echo $email;
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  $pdo = null;
} else {
  echo "";
}
?>
