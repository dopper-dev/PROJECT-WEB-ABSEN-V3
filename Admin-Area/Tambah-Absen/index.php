<?php

// lakukan koneksi ke database dan simpan data absensi jika form disubmit
date_default_timezone_set('Asia/Jakarta');

// membuat koneksi ke database MySQL
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_absensi";
$conn = mysqli_connect($host, $username, $password, $dbname);

// mengecek koneksi ke database
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// jika form disubmit, maka akan menyimpan data ke dalam database
if(isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $npm = $_POST['npm'];
    $email = $_POST['email'];
    $matkul = $_POST['matkul'];
    $kehadiran = $_POST['kehadiran'];
    $pertemuan = $_POST['pertemuan'];
    $semester = $_POST['semester'];
    $waktu_absen = date('Y-m-d H:i:s');

  // mengecek apakah mahasiswa sudah absen sebelumnya berdasarkan nama
  $sql_cek = "SELECT * FROM users WHERE nama='$nama'";
  $result = mysqli_query($conn, $sql_cek);
  if(mysqli_num_rows($result) > 0) {
      echo "<script>alert('Anda sudah melakukan absen sebelumnya.');</script>";
  } else {
      // mengecek apakah npm sudah ada dalam database
      $sql_cek_npm = "SELECT * FROM users WHERE npm='$npm'";
      $result_npm = mysqli_query($conn, $sql_cek_npm);
      if(mysqli_num_rows($result_npm) > 0) {
          echo "<script>alert('NPM sudah digunakan oleh mahasiswa lain.');</script>";
      } else {
          // memasukkan data ke dalam tabel absensi
          $sql = "INSERT INTO users (nama, npm, email, matkul, kehadiran, pertemuan, semester, waktu_absen)
                  VALUES ('$nama', '$npm', '$email', '$matkul', '$kehadiran', '$pertemuan', '$semester', '$waktu_absen')";
          if (mysqli_query($conn, $sql)) {
              echo "<script>alert('Data berhasil disimpan.');</script>";
          } else {
              echo "<script>alert('Terjadi kesalahan: " . mysqli_error($conn) . "');</script>";
          }
      }
  }
}

?>

<?php

session_start();
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

// Membuat query untuk mengambil data last_login dari tabel users
$admin_id = $_SESSION['admin_id'];
$sql = "SELECT last_login FROM admin WHERE id_admin = $admin_id";

// Menjalankan query
$result = mysqli_query($conn, $sql);

// Mengecek apakah query berhasil dijalankan dan menghasilkan data
if (mysqli_num_rows($result) > 0) {
  // Mendapatkan data last_login dari hasil query
  $row = mysqli_fetch_assoc($result);
  $admin_last_login = $row['last_login'];
} else {
  echo "Tidak ada data last_login yang ditemukan.";
}

// Mengambil user_id dari variabel session
$admin_id = $_SESSION['admin_id'];

// Membuat query untuk mengambil data username dari tabel users untuk user dengan user_id tertentu
$sql = "SELECT nama_pengguna_admin FROM admin WHERE id_admin = $admin_id";

// Menjalankan query
$result = mysqli_query($conn, $sql);

// Mengecek apakah query berhasil dijalankan dan menghasilkan data
if (mysqli_num_rows($result) > 0) {
  // Mendapatkan data username dari hasil query
  $row = mysqli_fetch_assoc($result);
  $nama_pengguna_admin = $row['nama_pengguna_admin'];
} else {
  echo "Tidak ada data username yang ditemukan.";
}

// Memeriksa apakah user sudah login dengan mengecek apakah session user_id tersedia
if (isset($_SESSION['admin_id'])) {
  // Mengambil data user_id dari session
  $user_id = $_SESSION['admin_id'];

  // Membuat query untuk mengambil data foto dari tabel users untuk user dengan user_id tertentu
  $sql = "SELECT image FROM admin WHERE id_admin =$admin_id";

  // Menjalankan query
  $result = mysqli_query($conn, $sql);

  // Mengecek apakah query berhasil dijalankan dan menghasilkan data
  if (mysqli_num_rows($result) > 0) {
    // Mendapatkan data foto dari hasil query
    $row = mysqli_fetch_assoc($result);
    $admin_image = $row['image'];
  } else {
    echo "Tidak ada data foto yang ditemukan.";
  }
} else {
  // Jika user belum login, maka arahkan ke halaman login
  header("Location: /");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Tambah Absen | RF</title>

  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="./gatau.css" rel="stylesheet">
  <link rel="apple-touch-icon" sizes="180x180" href="../Assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Favicon/icons8-synchronize-310.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Favicon/icons8-synchronize-310.png">
    <link rel="manifest" href="../Assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="../Favicon/icons8-synchronize-310.png" color="#5bbad5">
    <link rel="shortcut icon" href="../Favicon/icons8-synchronize-310.png">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../">
        <div class="sidebar-brand-icon">
          <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Absensi Mahasiswa</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="../">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

     
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="./">
          <i class="fas fa-fw fa-user-check"></i>
          <span>Tambah Absensi</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $nama_pengguna_admin ;?></span>
                <img class="img-profile rounded-circle" src="../Edit-Profile-Admin/uploads/<?= $admin_image; ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../Edit-Profile-Admin/">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

        <div class="container mt-5">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="card">
            <div class="card-header">
              <h4 class="text-center">ISI DATA ABSEN</h4>
            </div>
            <div class="card-body">
              <form method="post">
                <div class="form-group">
                  <label for="nama">Nama Lengkap</label>
                  <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                  <label for="npm">NPM</label>
                  <input type="number" class="form-control" id="npm" name="npm" pattern="[0-9]+" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                  <label for="matkul">Pertemuan</label>
                  <select class="form-control" id="pertemuan" name="pertemuan" required>
                    <option value="">-- Pilih Pertemuan --</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="matkul">Semester</label>
                  <select class="form-control" id="semester" name="semester" required>
                    <option value="">-- Pilih Semester --</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="matkul">Mata Kuliah</label>
                  <select class="form-control" id="matkul" name="matkul" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
              <option value="Sistem Digital">Sistem Digital</option>
              <option value="Algoritma2">Algoritma2</option>
              <option value="Pemograman2">Pemograman2</option>
              <option value="Bahasa Inggris Informatika">Bahasa Inggris Informatika</option>
              <option value="Logika Matematika">Logika Matematika</option>
              <option value="Kalkulus Lanjut">Kalkulus Lanjut</option>
              <option value="Komputer & Masyarakat">Komputer & Masyarakat</option>
              <option value="Kewarganegaraan">Kewarganegaraan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="matkul">Kehadiran</label>
                  <select class="form-control" id="kehadiran" name="kehadiran" required>
                    <option value="">-- Pilih Kehadiran --</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin">Izin</option>
                    <option value="Alpha">Alpha</option>
                    <option value="Tidak Hadir">Tidak Hadir</option>
                  </select>
                </div>
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-primary btn-block">Tambah Absen</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<p></p>
<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800 text-center">Recent Activity</h1>

            <!-- DataTales -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Terakhir Absen</h6>
            </div>
            <div class="card-body">             
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Nama Lengkap</th>
                      <th>Matakuliah</th>
                      <th>Waktu Absen</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                  
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

                        // Query untuk mengambil data absen dari tabel users
                        $sql="SELECT * FROM users";
                        $query=mysqli_query($conn,$sql);
                        $i = 1;
                        while ($data=mysqli_fetch_array($query)){
                            $nama=$data["nama"];
                            $matkul=$data["matkul"];
                            $waktu_absen=$data["waktu_absen"];

                  ?>

                    <tr>
                      <td><?=$i++;?></td>
                      <td><?= $nama;?></td>
                      <td><?= $matkul;?></td>
                      <td><?= $waktu_absen;?></td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
            </div>
          </div>
        </div>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
          <span>Copyright &copy; 
				<script>document.write(new Date().getFullYear());</script> 
				| All rights reserved</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih Logout untuk keluar</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
