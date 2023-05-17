<?php
// Konfigurasi koneksi database
$host = 'localhost'; // Isi dengan host database Anda
$user = 'root'; // Isi dengan username database Anda
$password = ''; // Isi dengan password database Anda
$dbname = 'db_absensi'; // Isi dengan nama database Anda

// Memeriksa apakah pengguna sudah memiliki session
session_start();
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum memiliki session, redirect ke halaman login
    header("Location: ../");
    exit();
}

// Membuat koneksi ke database
$conn = mysqli_connect($host, $user, $password, $dbname);

// Memeriksa apakah koneksi berhasil
if (!$conn) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

// Menutup koneksi database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>YouTube | Absensi Mahasiswa</title>
	<meta name="msapplication-square310x310logo" content="favicon/icons8-synchronize-310.png">
    <meta name="msapplication-TileColor" content="#C0FFEE">
    <meta name="application-name" content="Beautiful application name">
    <link rel="shortcut icon" href="../favicon/icons8-synchronize-310.png" type="image/png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style_youtube.css">
</head>
<body>
	<header>
		<h1>YouTube</h1>
		<nav>
            <a href="../">Dashboard</a>
        </nav>
		<input type="text" id="searchInput" placeholder="Search for videos...">
		<button id="searchBtn">Search</button>
	</header>
	<main>
		<div id="videoList"></div>
		<div class="buttons">
  			<button id="prevBtn">Previous</button>
  			<button id="nextBtn">Next</button>
		</div>
	</main>
	<footer>
		<p>&copy; 2023 YouTube All rights reserved.</p>
	</footer>
	<script src="script.js"></script>
	<script src="loader.js"></script>
	<style>img[alt="www.000webhost.com"]{display:none;}</style>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha3/js/bootstrap.bundle.min.js" integrity="sha512-vIAkTd3Ary9rwf0lrb9kIipyIkavKpYGnyopBXs6SiLfNSzAvCNvvQvKwBV5Xlag4O8oZpZ5U5n4bHoErGQxjw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha3/js/bootstrap.esm.min.js" integrity="sha512-GHn7y4oh9uyBM8EqwbUy0azy1kljegUOPsvZyITWl8Rgfx+VKFiA05H2VbVy6n2WXcstquOHngi3q8hMlVLg9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha3/js/bootstrap.min.js" integrity="sha512-wOLiP6uL5tNrV1FiutKtAyQGGJ1CWAsqQ6Kp2XZ12/CvZxw8MvNJfdhh0yTwjPIir4SWag2/MHrseR7PRmNtvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>
