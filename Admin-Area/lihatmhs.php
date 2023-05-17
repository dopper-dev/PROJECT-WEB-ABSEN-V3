<?php
	
  session_start();
  if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

if(isset($_SESSION['pesan_success']));

	include "koneksi.php";
	/*
	if(isset($_session['id'])){
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';	
	}*/		
	$admin_id = $_SESSION['admin_id'];
	
	
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
  $admin_nama = $row['nama_pengguna_admin'];
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
    $admin_foto = $row['image'];
  } else {
    echo "Tidak ada data foto yang ditemukan.";
  }
} else {
  // Jika user belum login, maka arahkan ke halaman login
  header("Location: login.php");
  exit();
}

?>

<?php

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

// Query untuk mengambil id user dari table users_db
$sql = "SELECT id FROM users_db";

// Menjalankan query
$result = mysqli_query($conn, $sql);

// Memeriksa apakah query berhasil dijalankan
if (mysqli_num_rows($result) > 0) {
  // Menampilkan data id user
  while ($row = mysqli_fetch_assoc($result)) {
    $id_user = $row["id"];
  }
}

// Menutup koneksi database
mysqli_close($conn);

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Lihat Mahasiswa | Absensi Mahasiswa</title>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="apple-touch-icon" sizes="180x180" href="Assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Favicon/icons8-synchronize-310.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Favicon/icons8-synchronize-310.png">
    <link rel="manifest" href="Assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="Favicon/icons8-synchronize-310.png" color="#5bbad5">
    <link rel="shortcut icon" href="Favicon/icons8-synchronize-310.png">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Absensi Mahasiswa</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="./">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

     
      <li class="nav-item">
        <a class="nav-link" href="./Tambah-Absen/">
          <i class="fas fa-fw fa-user-check"></i>
          <span>Tambah Absen</span></a>
      </li>

      <hr class="sidebar-divider d-none d-md-block">

      <!-- Nav Item - Charts
          <li class="nav-item">
        <a class="nav-link" href="absensi.php">
          <i class="fas fa-fw fa-user-check"></i>
          <span>Absensi</span></a>
      </li>
    -->


      <!-- Nav Item - Tables -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="nilai.php">
          <i class="fas fa-fw fa-book"></i>
          <span>Nilai Tugas</span></a>
      </li> -->

      <!-- Divider 
    <hr class="sidebar-divider d-none d-md-block">
    -->

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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $admin_nama ;?></span>
                <img class="img-profile rounded-circle" src="./Edit-Profile-Admin/uploads/<?= $admin_foto; ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../Admin-Area/Edit-Profile-Admin/">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
                </a>
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Pengaturan
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="./logout.php" data-toggle="modal" data-target="#logoutModal">
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

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Lihat Mahasiswa</h1>

            <!-- DataTales -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Mahasiswa </h6>
            </div>
            <div class="card-body">             
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Profil</th>
                      <th>Nama Lengkap</th>
                      <th>Email</th>
                      <th>Terakhir Login</th>
                      <th>Aksi</th>
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

                    $sql="SELECT * FROM users_db";
                    $query=mysqli_query($koneksi,$sql);
                    $i = 1;
                    while ($data=mysqli_fetch_array($query)){
                      $id = $data["id"];  
                      $image = $data["image"];
                        $nama_pengguna = $data["nama_pengguna"];
                        $email = $data["email"];
                        $last_login = $data["last_login"];

                    ?>
                    <tr>
                      <td><?=$i++;?></td>
                      <td><img class="img-profile rounded-circle" style="width:50px;height:50px;" src="../Dashboard/Edit-Profile/uploads/<?=$image?>"></td>
                      <td><?= $nama_pengguna;?></td>
                      <td><?= $email;?></td>
                      <td><?= $last_login;?></td>
                      <td>
                          <a href="delete.php?id=<?= $id ?>" class="btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Hapus Data</span>
                          </a>
                          <a href="../Edit-Profile-User/?id=<?=$id?>" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-user"></i>
                    </span>
                    <span class="text">Lihat Detail</span>
                    </a>
                      </td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

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
        <div class="modal-body">Pilih Logout untuk keluar.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
