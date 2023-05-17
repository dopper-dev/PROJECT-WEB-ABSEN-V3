<?php
// Mulai session
session_start();

// Cek apakah user sudah login
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

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

// Mengambil id pengguna dari session
$admin_id = $_SESSION['admin_id'];

// Mengambil data pengguna dari database
$sql = "SELECT * FROM admin WHERE id_admin=$admin_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Memeriksa apakah data foto pengguna sudah tersimpan di database
if(empty($user['image'])) {
    $image_url = 'default.png';
} else {
    $image_url = '../img' . $user['image'];
}

// Memeriksa apakah form edit foto sudah dikirimkan
if(isset($_POST['submit'])) {
    // Mengambil data dari form
    $file = $_FILES['image'];

    // Memeriksa apakah file foto sudah dipilih
    if($file['error'] == 4) {
        $error = 'Anda belum memilih foto';
    } else {
        // Mengambil informasi file foto
        $file_name = $file['name'];
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];
        $file_type = $file['type'];
        $file_ext = strtolower(end(explode('.', $file_name)));

        // Membuat array ekstensi file yang diizinkan
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');

        // Memeriksa apakah ekstensi file foto diizinkan
        if(in_array($file_ext, $allowed_ext) === false) {
            $error = 'Ekstensi file tidak diizinkan';
        } else {
            // Memeriksa apakah ukuran file foto tidak melebihi batas maksimum
            if($file_size > 5242880) {
                $error = 'Ukuran file terlalu besar. Maksimum 5 MB';
            } else {
                // Menghapus foto lama pengguna jika ada
                if(!empty($user['image'])) {
                    unlink('uploads/' . $user['image']);
                }

                // Menyimpan foto baru pengguna ke dalam folder uploads
                $new_file_name = uniqid() . '.' . $file_ext;
                move_uploaded_file($file_tmp, 'uploads/' . $new_file_name);

                // Memperbarui data pengguna di database dengan foto yang baru
                $sql_update = "UPDATE admin SET image='$new_file_name' WHERE id_admin=$admin_id";
                mysqli_query($conn, $sql_update);

                // Redirect ke halaman profile
                header("Location: ./");
                exit();
            }
        }
    }
}
?>