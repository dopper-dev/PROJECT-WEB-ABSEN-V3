<?php 
session_start();

// Menghapus semua variabel session
session_unset();

unset($_SESSION['user_id']);

// Menghapus session
session_destroy();

// Mengarahkan pengguna ke halaman login
header("Location: ../Sign-In/");
?>
