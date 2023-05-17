<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Area</title>
    <link rel="icon" type="image/png" sizes="32x32" href="../Favicon/icons8-synchronize-310.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Favicon/icons8-synchronize-310.png">
    <link rel="mask-icon" href="../Favicon/icons8-synchronize-310.png" color="#5bbad5">
    <link rel="shortcut icon" href="../Favicon/icons8-synchronize-310.png">
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
        
        <?php
        date_default_timezone_set('Asia/Jakarta');
// Konfigurasi koneksi database
$host = 'localhost'; // Isi dengan host database Anda, misalnya 'localhost'
$user = 'root'; // Isi dengan username database Anda
$password = ''; // Isi dengan password database Anda
$dbname = 'db_absensi'; // Isi dengan nama database Anda

// Membuat koneksi ke database
$conn = mysqli_connect($host, $user, $password, $dbname);

// Memeriksa apakah koneksi berhasil
if (!$conn) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

// Memeriksa apakah data sudah dikirimkan dari form login
if(isset($_POST['login'])) {
  // Mengambil data dari form
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Menghindari SQL injection dengan menghindari penggunaan variable langsung pada query
  $username = mysqli_real_escape_string($conn, $username);
  $password = mysqli_real_escape_string($conn, $password);

  // Menyiapkan query untuk memeriksa apakah username dan password sesuai
  $sql_check = "SELECT * FROM users_db WHERE username='$username' AND password='$password'";

  // Menjalankan query untuk memeriksa apakah username dan password sesuai
  $result_check = mysqli_query($conn, $sql_check);

  // Memeriksa apakah query berhasil dijalankan dan jumlah baris hasil query lebih dari 0
  if (mysqli_num_rows($result_check) > 0) {
      // Mengambil data user dari hasil query
      $row = mysqli_fetch_assoc($result_check);

      // Memeriksa apakah user yang login sesuai dengan user yang dimaksud
      if ($row['username'] === $username) {
          // Menyimpan data user ke dalam session
          session_start();
          $_SESSION['user_id'] = $row['id'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['online_users'] = 1; // Menambahkan variabel online_users ke dalam session
          // Mengupdate waktu terakhir login
          $id = $row['id'];
          $last_login = date('Y-m-d H:i:s');
          $sql_update = "UPDATE users_db SET last_login='$last_login' WHERE id=$id";
          mysqli_query($conn, $sql_update);
          // Redirect ke halaman utama
          header("Location: /");
          exit();
      } else {
          // Menampilkan pesan error jika username atau password tidak sesuai
          echo '<div class="error-box">Anda tidak memiliki akses ke akun ini.</div>';
      }
  } else {
      // Menampilkan pesan error jika username atau password tidak sesuai
      echo '<div class="error-box">Username atau password salah. Silakan coba lagi</div>';
  }
}

else if(isset($_POST['register'])) {
  // Mengambil data dari form
  $nama_pengguna = $_POST['nama_pengguna'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Menyiapkan query untuk memeriksa apakah username atau email sudah terdaftar
  $sql_check = "SELECT * FROM users_db WHERE nama_pengguna='$nama_pengguna' OR username='$username' OR email='$email'";

  // Menjalankan query untuk memeriksa apakah username atau email sudah terdaftar
  $result_check = mysqli_query($conn, $sql_check);

  // Memeriksa apakah query berhasil dijalankan
  if (mysqli_num_rows($result_check) > 0) {
      // Menampilkan pesan error jika username atau email sudah terdaftar
      echo '<div class="error-box">Username atau email sudah terdaftar. Silakan coba lagi dengan username atau email yang berbeda.</div>';
  } else {
      // Menyiapkan query untuk memasukkan data ke database
      $sql_register = "INSERT INTO users_db (nama_pengguna,username, email, password) VALUES ('$nama_pengguna', '$username', '$email', '$password')";

      // Menjalankan query untuk memasukkan data ke database
      if (mysqli_query($conn, $sql_register)) {
          // Redirect ke halaman login jika pendaftaran berhasil
          header("Location: #bagian-login");
          exit();
      } else {
          // Menampilkan pesan error jika pendaftaran gagal
          echo '<div class="error-box">Terjadi kesalahan: ' . mysqli_error($conn) . '</div>';
      }
  }
}

// Memeriksa apakah pengguna sudah memiliki session
session_start();
if (isset($_SESSION['username'])) {
    // Jika pengguna sudah memiliki session, langsung redirect ke halaman utama
    header("Location: /");
    exit();
}

// Menutup koneksi database
mysqli_close($conn);
?>

          <form class="sign-in-form" method="POST">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" id="username" name="username" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" id="password" name="password" placeholder="Password" />
            </div>
            <input type="submit" value="Login" name="login" class="btn solid" />
          </form>

          <form class="sign-up-form" method="POST">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" id="nama_pengguna" name="nama_pengguna" placeholder="Nama Pengguna" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" id="username" name="username" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" id="email" name="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" id="password" name="password" placeholder="Password" />
            </div>
            <input type="submit" class="btn" name="register" value="Sign up" />
          </form>
        </div>
      </div>

      <div class="panels-container" id="bagian-register">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Sign up now to track your attendance easily!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
            <a href="../Admin-Area/"><button class="btn transparent">
              Admin
            </button></a>
            <p class="social-text">Back To Home ?</p>
          <div class="social-media">
              <a href="/"><button type="home" class="btn transparent secondary">Home</button></a>
            </div>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel" id="bagian-login">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
            Log in now to access your account and start managing your attendance records more efficiently!
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>
