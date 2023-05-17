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

// Memeriksa apakah pengguna masih aktif dalam database
$username = $_SESSION['username'];

$query = "SELECT * FROM users_db WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    // Jika pengguna tidak ditemukan di database, logout dan redirect ke halaman login
    session_destroy();
    header("Location: /");
    exit();
}

// Menutup koneksi database
mysqli_close($conn);
?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Drawing App | Absensi Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js" defer></script>
    <link rel="apple-touch-icon" sizes="180x180" href="/Assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/Favicon/icons8-synchronize-310.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/Favicon/icons8-synchronize-310.png">
    <link rel="manifest" href="/Assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="/Favicon/icons8-synchronize-310.png" color="#5bbad5">
  </head>
  <body>
    <div class="container">
      <section class="tools-board">
        <div class="row">
          <label class="title">Shapes</label>
          <ul class="options">
            <li class="option tool" id="rectangle">
              <img src="icons/rectangle.svg" alt="">
              <span>Rectangle</span>
            </li>
            <li class="option tool" id="circle">
              <img src="icons/circle.svg" alt="">
              <span>Circle</span>
            </li>
            <li class="option tool" id="triangle">
              <img src="icons/triangle.svg" alt="">
              <span>Triangle</span>
            </li>
            <li class="option">
              <input type="checkbox" id="fill-color">
              <label for="fill-color">Fill color</label>
            </li>
          </ul>
        </div>
        <div class="row">
          <label class="title">Options</label>
          <ul class="options">
            <li class="option active tool" id="brush">
              <img src="icons/brush.svg" alt="">
              <span>Brush</span>
            </li>
            <li class="option tool" id="eraser">
              <img src="icons/eraser.svg" alt="">
              <span>Eraser</span>
            </li>
            <li class="option">
              <input type="range" id="size-slider" min="1" max="30" value="5">
            </li>
          </ul>
        </div>
        <div class="row colors">
          <label class="title">Colors</label>
          <ul class="options">
            <li class="option"></li>
            <li class="option selected"></li>
            <li class="option"></li>
            <li class="option"></li>
            <li class="option">
              <input type="color" id="color-picker" value="#4A98F7">
            </li>
          </ul>
        </div>
        <div class="row buttons">
          <button class="clear-canvas">Clear Canvas</button>
          <button class="save-img">Save As Image</button>
          <a href="../"><button class="save-img">Home</button></a>
        </div>
      </section>
      <section class="drawing-board">
        <canvas></canvas>
      </section>
    </div>
    
  </body>
</html>