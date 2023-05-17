<?php
// Konfigurasi koneksi database
$host = 'localhost'; // Isi dengan host database Anda
$user = 'root'; // Isi dengan username database Anda
$password = ''; // Isi dengan password database Anda
$dbname = 'db_absensi'; // Isi dengan nama database Anda

// Membuat koneksi ke database
$conn = mysqli_connect($host, $user, $password, $dbname);

// Memeriksa apakah koneksi berhasil
if (!$conn) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

// Memeriksa apakah pengguna sudah memiliki session
session_start();
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum memiliki session, redirect ke halaman login
    header("Location: /");
    exit();
}

// Menutup koneksi database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'views/layouts/head_home.php'; ?>
</head>
<body>
  <nav>
    <div class="container">
      <img src="assets/favicon.png" alt="" width="33px" srcset="" style="margin-right: 5px;">
      <a href="#" class="logo">Auto Nulis V2</a>
      <ul class="nav-menu">
        <li><a href="./">Home</a></li>
        <li><a href="../">Kembali Ke Utama</a></li>
        <li><a href="nulis.php">Menulis <i class='bx bx-chevron-right'></i></a></li>
      </ul>
      <i class='bx bx-menu toggle-menu'></i>
    </div>
  </nav>
  <header id="home">
    <div class="container">
      <div class="left">
        <img src="assets/header_image.png" alt="">
      </div>
      <div class="right">
        <h4>Nulis tapi online 😲 <br>Emang bisa 🤔</h4>
        <h1 class="desc">Disini pasti bisa! Biar kalian gak capek ngetik mending Nulis Online aja.</h1>
        <div class="links">
          <a href="nulis.php" class="btn">Menulis 📝</a>
          <a href="https://wa.me/6285156306684" target="_blank"><i class='bx bxl-whatsapp'></i></a>
          <a href="https://instagram.com/" target="_blank"><i class='bx bxl-instagram'></i></a>
          <a href="https://t.me" target="_blank"><i class='bx bxl-telegram'></i></a>
        </div>
      </div>
    </div>
  </header>
  <section id="statistics">
    <div class="container">
      <div class="left">
        <h1><span>📊</span>Based on Statistics</h1>
      </div>
      <div class="right">
        <div class="box">
          <div class="banner">
            <h1><span id="visits"></span><i class='bx bx-show'></i></h4>
          </div>
          <h4></h4>
        </div>
        <div class="box">
          <div class="banner">
            <h1><span id="used"></span><i class='bx bx-book-bookmark'></i></h4>
          </div>
          <h4></h4>
        </div>
        <div class="box">
          <div class="banner">
            <h1><span id="users"></span><i class='bx bx-user'></i></h4>
          </div>
          <h4></h4>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="container">
      <img src="assets/favicon.png" alt="" width="33px" srcset="" style="margin-right: 5px;">
      <a href="./" class="logo">Auto Nulis V2</a>
      <p> </p>
    </div>
  </footer>
 <script src="js/home.js"></script></body></html>