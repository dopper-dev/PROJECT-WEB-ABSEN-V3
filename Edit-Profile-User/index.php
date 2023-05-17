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
if (!isset($_SESSION['admin_id'])) {
    // Jika pengguna belum memiliki session, redirect ke halaman login
    header("Location: ../Sign-In/");
    exit();
}

// Menutup koneksi database
mysqli_close($conn);
?>

<?php
date_default_timezone_set('Asia/Jakarta');

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

// Mengecek apakah ID pengguna telah diberikan di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data pengguna berdasarkan ID
    $query = "SELECT * FROM users_db WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah query berhasil dieksekusi
    if ($result) {
        // Memeriksa apakah terdapat data yang diambil
        if (mysqli_num_rows($result) > 0) {
            // Mengambil data pengguna
            $row = mysqli_fetch_assoc($result);
            $nama_pengguna = $row['nama_pengguna'];
            $email = $row['email'];
            $password = $row['password'];
            $image = $row['image'];
        } else {
            echo "Pengguna dengan ID tersebut tidak ditemukan.";
            exit();
        }
    }
} else {
    echo "ID pengguna tidak diberikan di URL.";
    exit();
}

// Menutup koneksi database
mysqli_close($conn);
?>

<?php
// Periksa apakah form dikirimkan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $nama_pengguna = $_POST['nama_pengguna'];
    $email = $_POST['email'];
    $old_image = $_POST['old_image'];

    // Proses update data ke database
    // Pastikan Anda telah mengatur koneksi ke database sebelum menggunakan kode ini

    // Koneksi ke database
    $host = 'localhost';
    $username = 'root';
    $password_db = '';
    $database = 'db_absensi';

    // Membuat koneksi
    $koneksi = mysqli_connect($host, $username, $password_db, $database);

    // Periksa koneksi
    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal: " . mysqli_connect_error();
        exit();
    }

    // Query SQL untuk melakukan update data
    $query = "UPDATE users_db SET 
              nama_pengguna = '$nama_pengguna',
              email = '$email'
              WHERE id = '$id'"; // Menggunakan $id yang telah diambil dari URL

    // Jalankan query update
    if (mysqli_query($koneksi, $query)) {
        // Jika update berhasil, lanjutkan dengan mengunggah gambar profil jika ada
        if ($_FILES['image']['name'] != '') {
            // Mengunggah gambar profil baru
            $new_image = $_FILES['image']['name'];

            // Menghapus gambar profil lama jika ada
            if ($old_image != '') {
                unlink("../Dashboard/Edit-Profile/uploads/" . $old_image);
            }

            // Memindahkan gambar baru ke folder uploads
            move_uploaded_file($_FILES['image']['tmp_name'], "../Dashboard/Edit-Profile/uploads/" . $new_image);

            // Update data gambar profil di database
            $query_image = "UPDATE users_db SET image = '$new_image' WHERE id = '$id'"; // Menggunakan $id yang telah diambil dari URL
            mysqli_query($koneksi, $query_image);
        }

        // Redirect ke halaman sukses dengan pesan success
        header("Location: ?id=$id&success=This account has been updated successfully");
        exit();
    } else {
        // Redirect ke halaman edit dengan pesan error
        header("Location: &error=Failed to update your account");
        exit();
    }
}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Profile | Absensi Mahasiswa</title>
  <link rel="apple-touch-icon" sizes="180x180" href="../Assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Favicon/icons8-synchronize-310.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Favicon/icons8-synchronize-310.png">
    <link rel="manifest" href="../Assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="../Favicon/icons8-synchronize-310.png" color="#5bbad5">
    <link rel="shortcut icon" href="../Favicon/icons8-synchronize-310.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <div class="d-flex justify-content-center align-items-center vh-100">
        
        <form class="shadow w-450 p-3" method="post"
              enctype="multipart/form-data">

            <h4 class="display-4  fs-1">Edit Profile</h4><br>
            <!-- error -->
            <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $_GET['error']; ?>
            </div>
            <?php } ?>
            
            <!-- success -->
            <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-success" role="alert">
              <?php echo $_GET['success']; ?>
            </div>
            <?php } ?>

          <div class="mb-3">
            <label class="form-label">Nama Pengguna</label>
            <input type="text" 
                   class="form-control"
                   name="nama_pengguna"
                   value="<?php echo $nama_pengguna?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" 
                   class="form-control"
                   name="email"
                   value="<?php echo $email?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Profile Picture</label>
            <input type="file" class="form-control mb-2" name="image">
            <img src="../Dashboard/Edit-Profile/uploads/<?=$image?>" class="rounded-circle" style="width: 70px">
            <input type="text" hidden="hidden" name="old_image" value="<?=$image?>" >
          </div>
          
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="../Admin-Area/lihatmhs.php" class="btn btn-secondary">Home</a>
        </form>
    </div>

    


    <script>
    const showPasswordBtn = document.getElementById("show-password-btn");
const passwordInput = document.getElementsByName("password")[0];

showPasswordBtn.addEventListener("click", () => {
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    showPasswordBtn.textContent = "Hide";
  } else {
    passwordInput.type = "password";
    showPasswordBtn.textContent = "Show";
  }
});
</script>
</body>
</html>