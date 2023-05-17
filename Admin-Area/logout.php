<?php
session_start();

unset($_SESSION['admin_id']);

// Menghapus session
session_destroy();

// Mengarahkan pengguna ke halaman login
header("Location: login.php");
exit();
?>
