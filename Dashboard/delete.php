<?php
date_default_timezone_set('Asia/Jakarta');

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_absensi");

// cek koneksi
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// hapus data pesan yang terkirim lebih dari satu hari yang lalu
$one_day_ago = date("Y-m-d H:i:s", strtotime("-1 day"));
$sql = "DELETE FROM chat_messages WHERE created_at < '$one_day_ago'";
$result = mysqli_query($conn, $sql);

if ($result) {
  echo "Data pesan yang terkirim lebih dari satu hari yang lalu telah dihapus.";
} else {
  echo "Terjadi kesalahan saat menghapus data pesan: " . mysqli_error($conn);
}

// tutup koneksi
mysqli_close($conn);

?>
