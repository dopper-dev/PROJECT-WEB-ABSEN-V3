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

// Membuat query untuk mengambil data last_login dari tabel users
$user_id = $_SESSION['user_id'];
$sql = "SELECT last_login FROM users_db WHERE id = $user_id";

// Menjalankan query
$result = mysqli_query($conn, $sql);

// Mengecek apakah query berhasil dijalankan dan menghasilkan data
if (mysqli_num_rows($result) > 0) {
  // Mendapatkan data last_login dari hasil query
  $row = mysqli_fetch_assoc($result);
  $last_login = $row['last_login'];
} else {
  echo "Tidak ada data last_login yang ditemukan.";
}

// Mengambil user_id dari variabel session
$user_id = $_SESSION['user_id'];

// Membuat query untuk mengambil data username dari tabel users untuk user dengan user_id tertentu
$sql = "SELECT username FROM users_db WHERE id = $user_id";

// Menjalankan query
$result = mysqli_query($conn, $sql);

// Mengecek apakah query berhasil dijalankan dan menghasilkan data
if (mysqli_num_rows($result) > 0) {
  // Mendapatkan data username dari hasil query
  $row = mysqli_fetch_assoc($result);
  $username = $row['username'];
} else {
  echo "Tidak ada data username yang ditemukan.";
}

// Mengambil user_id dari variabel session
$user_id = $_SESSION['user_id'];

// Membuat query untuk mengambil data username dari tabel users untuk user dengan user_id tertentu
$sql = "SELECT nama_pengguna FROM users_db WHERE id = $user_id";

// Menjalankan query
$result = mysqli_query($conn, $sql);

// Mengecek apakah query berhasil dijalankan dan menghasilkan data
if (mysqli_num_rows($result) > 0) {
  // Mendapatkan data username dari hasil query
  $row = mysqli_fetch_assoc($result);
  $nama_pengguna = $row['nama_pengguna'];
} else {
  echo "Tidak ada data username yang ditemukan.";
}


// Memeriksa apakah user sudah login dengan mengecek apakah session user_id tersedia
if (isset($_SESSION['user_id'])) {
  // Mengambil data user_id dari session
  $user_id = $_SESSION['user_id'];

  // Membuat query untuk mengambil data foto dari tabel users untuk user dengan user_id tertentu
  $sql = "SELECT image FROM users_db WHERE id=$user_id";

  // Menjalankan query
  $result = mysqli_query($conn, $sql);

  // Mengecek apakah query berhasil dijalankan dan menghasilkan data
  if (mysqli_num_rows($result) > 0) {
    // Mendapatkan data foto dari hasil query
    $row = mysqli_fetch_assoc($result);
    $image = $row['image'];
  } else {
    echo "Tidak ada data foto yang ditemukan.";
  }
} else {
  // Jika user belum login, maka arahkan ke halaman login
  header("Location: login.php");
  exit();
}


// Mengecek koneksi
if (!$conn) {
  die('Koneksi database gagal: ' . mysqli_connect_error());
}

// Membuat query untuk mengambil jumlah mahasiswa terdaftar dari tabel users
$sql = "SELECT COUNT(*) AS jumlah_mahasiswa FROM users_db";

// Menjalankan query
$result = mysqli_query($conn, $sql);

// Mengecek apakah query berhasil dijalankan dan menghasilkan data
if (mysqli_num_rows($result) > 0) {
  // Mendapatkan data jumlah mahasiswa terdaftar dari hasil query
  $row = mysqli_fetch_assoc($result);
  $jumlah_mahasiswa = $row['jumlah_mahasiswa'];
} else {
  echo "Tidak ada data mahasiswa yang ditemukan.";
}

// Membuat query untuk mengambil jumlah absen mahasiswa yang sudah dilakukan dari tabel users
$sql = "SELECT COUNT(*) AS jumlah_absen FROM users";

// Menjalankan query
$result = mysqli_query($conn, $sql);

// Mengecek apakah query berhasil dijalankan dan menghasilkan data
if (mysqli_num_rows($result) > 0) {
  // Mendapatkan data jumlah absen mahasiswa dari hasil query
  $row = mysqli_fetch_assoc($result);
  $jumlah_absen = $row['jumlah_absen'];
} else {
  echo "Tidak ada data absen mahasiswa yang ditemukan.";
}

// Menjalankan query untuk mengambil jumlah absen tiap matkul
$query = "SELECT matkul, COUNT(*) as jumlah_matkul_absen FROM users GROUP BY matkul";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  // Inisialisasi variabel sebagai string kosong
  $jumlah_matkul_absen = '';

  // Tampilkan hasil query
  while ($row = mysqli_fetch_assoc($result)) {
      $jumlah_matkul_absen .= $row['matkul'] . ' = ' . $row['jumlah_matkul_absen'] . '<br>';
  }
} else {
  $jumlah_matkul_absen = 'Data kosong';
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

  <title>Dashboard | Absensi Mahasiswa</title>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="css/chart.css" rel="stylesheet" type="text/css">
  <link href="chat-baru.css" rel="stylesheet" type="text/css">
  <link rel="apple-touch-icon" sizes="180x180" href="../Assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Favicon/icons8-synchronize-310.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Favicon/icons8-synchronize-310.png">
    <link rel="manifest" href="../Assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="../Favicon/icons8-synchronize-310.png" color="#5bbad5">
    <link rel="shortcut icon" href="../Favicon/icons8-synchronize-310.png">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.2.0/socket.io.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
      <!-- Montserrat Font -->
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
      <link href='https://unpkg.com/css.gg@2.0.0/icons/css/screen.css' rel='stylesheet'>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
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

     
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="Absensi/">
          <i class="fas fa-fw fa-user-check"></i>
          <span>Absensi</span></a>
      </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

     
        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="DrawingApp/">
            <i class="fas fa-paint-brush"></i>
            <span>Drawing App</span></a>
        </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
        <a class="nav-link" href="./Auto-Nulis-V2/">
          <i class="fas fa-book fa-2x"></i>
          <span>Auto Nulis V2</span></a>
      </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

              <!-- Nav Item - Charts -->
              <li class="nav-item">
              <a class="nav-link" href="./YouTube/">
              <i class="fa fa-youtube-play"></i>
              <span>YouTube Anti Iklan</span></a>
              </li>

                  <!-- Divider -->
                  <hr class="sidebar-divider">

                    <!-- Nav Item - Charts -->
                    <li class="nav-item">
                    <a class="nav-link" href="./YouTube-Downloader/">
                    <i class="fa fa-youtube-play"></i>
                    <span>YouTube Downloader</span></a>
                    </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
     
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="/">
          <i class="bx bxl-dribbble"></i>
          <span>Home</span></a>
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

       <!-- Sidebar Toggle (Topbar) -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <li class="nav align-items-center">
            <span class="mr-2 d-none d-lg-inline text-gray-600 medium">Terakhir Login : <span class="text-success"><?=$last_login?></span></span>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 medium"><?=$nama_pengguna?></span>
                <img class="img-profile rounded-circle" src="Edit-Profile/uploads/<?=$image?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="./Edit-Profile/">
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

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

          <div class="row">

          <!-- Lihat Mahasiswa  -->

          <!-- <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-success shadow h-100 py-2">
                 <a href="lihatmhs.php" style="text-decoration:none;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Mahasiswa <br>Yang Terdaftar</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_mahasiswa?> (Mahasiswa)</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>  -->

          <!-- Lihat Mahasiswa  -->
          <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Mahasiswa <br>Yang Terdaftar</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_mahasiswa?> (Mahasiswa)</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Akhir Lihat Mahasiswa -->

            <!-- <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-primary shadow h-100 py-2">
              <a href="lihatkelas.php" style="text-decoration:none;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total <br> Mahasiswa Yang Sudah Absen</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_absen?> (Sudah Absen)</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </a>
              </div>
            </div> -->

            <!-- Tugas -->
            <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total <br> Mahasiswa Yang Sudah Absen</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_absen?> (Sudah Absen)</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </a>
              </div>
            </div>
            <!-- Akhir Tugas -->

            <!-- <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-danger shadow h-100 py-2">
              <a href="lihatmatkul.php" style="text-decoration:none;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Live Total <br> Absen Matkul</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jumlah_matkul_absen?> (Live)</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div> -->

            <!-- Rekap Absensi -->
         <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Live Total <br> Absen Matkul</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jumlah_matkul_absen?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Akhir Rekap Absensi -->
            <!-- Rekap Absensi -->
         <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-warning shadow h-100 py-2">
              <a href="#" style="text-decoration:none;" data-toggle="modal" data-target="#comingModal">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tugas <br> yang sedang aktif</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">- (Tugas)</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>
            <!-- Akhir Rekap Absensi -->
            
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php

            // lakukan koneksi ke database
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "db_absensi";
            $conn = mysqli_connect($host, $username, $password, $dbname);

            // mengecek koneksi ke database
            if (!$conn) {
                die("Koneksi gagal: " . mysqli_connect_error());
            }

            // mengambil data absensi dari database
            $sql = "SELECT kehadiran, COUNT(*) AS jumlah FROM users GROUP BY kehadiran";
            $result = mysqli_query($conn, $sql);

            // menyimpan data ke dalam array
            $labels = array();
            $data = array();
            $backgroundColors = array();
            $borderColors = array();

            while($row = mysqli_fetch_assoc($result)) {
                $labels[] = $row['kehadiran'];
                $data[] = $row['jumlah'];

                // menentukan warna latar dan garis pada grafik
                switch ($row['kehadiran']) {
                    case 'Hadir':
                        $backgroundColors[] = 'rgba(54, 162, 235, 0.2)';
                        $borderColors[] = 'rgba(54, 162, 235, 1)';
                        break;
                    case 'Sakit':
                        $backgroundColors[] = 'rgba(255, 206, 86, 0.2)';
                        $borderColors[] = 'rgba(255, 206, 86, 1)';
                        break;
                    case 'Izin':
                        $backgroundColors[] = 'rgba(75, 192, 192, 0.2)';
                        $borderColors[] = 'rgba(75, 192, 192, 1)';
                        break;
                    case 'Alpha':
                        $backgroundColors[] = 'rgba(255, 99, 132, 0.2)';
                        $borderColors[] = 'rgba(255, 99, 132, 1)';
                        break;
                    case 'Tidak Hadir':
                        $backgroundColors[] = 'rgba(128, 128, 128, 0.2)';
                        $borderColors[] = 'rgba(128, 128, 128, 1)';
                        break;
                }
            }

            // tutup koneksi ke database
            mysqli_close($conn);
      ?>

<div class="charts">
      <div class="charts-card">
        <h2 class="chart-title">Grafik Abasensi</h2>
        <div id="bar-chart"></div>
      </div>

      <div class="charts-card">
            <h2 class="chart-title">Live Chat</h2>
            <div id="chat-container"><div id="message-container"></div><form id="message-form">
                  <input type="text" id="message-input" placeholder="Ketik pesan Anda...">
                  <button type="submit">Kirim</button>
                </form></div>
      </div>
</div>

<script src="app.js"></script>

<!-- Scripts -->
<!-- ApexCharts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
<!-- Custom JS -->

<script>

      // ---------- CHARTS ----------

      // BAR CHART
      var barChartOptions = {
        series: [{
          data: <?php echo json_encode($data); ?>,
        }],
        chart: {
          type: "bar",
          background: "transparent",
          height: 350,
        },
        colors: [
          "rgba(5, 110, 180, 0.5)",
          "rgba(224, 176, 53, 0.5)",
          "rgba(20, 241, 86, 0.5)",
          "rgba(235, 47, 87, 0.5)",
          "rgba(39, 38, 38, 0.5)",
        ],
        plotOptions: {
          bar: {
            distributed: true,
            borderRadius: 4,
            horizontal: false,
            columnWidth: "40%",
          }
        },
        dataLabels: {
          enabled: false,
        },
        fill: {
          opacity: 1,
        },
        grid: {
          borderColor: "#55596e",
          yaxis: {
            lines: {
              show: true,
            },
          },
          xaxis: {
            lines: {
              show: true,
            },
          },
        },
        legend: {
          labels: {
            colors: "rgba(46, 44, 44, 0.95)",
          },
          show: true,
          position: "top",
        },
        stroke: {
          colors: ["transparent"],
          show: true,
          width: 2
        },
        xaxis: {
          categories: <?php echo json_encode($labels); ?>,
          title: {
            style: {
              color: "#f5f7ff",
            },
          },
          axisBorder: {
            show: true,
            color: "#55596e",
          },
          axisTicks: {
            show: true,
            color: "#55596e",
          },
          labels: {
            style: {
              colors: "rgba(46, 44, 44, 0.95)",
            },
          },
        },
        yaxis: {
          title: {
            text: "Count",
            style: {
              color:  "rgba(46, 44, 44, 0.95)",
            },
          },
          axisBorder: {
            color: "#55596e",
            show: true,
          },
          axisTicks: {
            color: "#55596e",
            show: true,
          },
          labels: {
            style: {
              colors: "rgba(46, 44, 44, 0.95)",
            },
          },
        }
      };

      var barChart = new ApexCharts(document.querySelector("#bar-chart"), barChartOptions);
      barChart.render();
</script>

<!-- kode JavaScript untuk membuat grafik menggunakan chart.js -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	var ctx = document.getElementById('myChart').getContext('2d');
	var chart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: <?php echo json_encode($labels); ?>,
			datasets: [{
				label: 'Jumlah',
				data: <?php echo json_encode($data); ?>,
				backgroundColor: <?php echo json_encode($backgroundColors); ?>,
				borderColor: <?php echo json_encode($borderColors); ?>,
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
</script>s -->

      <!-- GPT AREA -->
<style>
            .container-1 {
              display: flex;
              flex-direction: column;
              justify-content: center;
              align-items: center;
              background-color: #f2f2f2;
              padding: 20px;
              overflow-y: auto;
              border-radius: 10px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
              width: 100%;
              max-width: 500px;
              margin: 0 auto;
            }

            h3 {
              text-align: center;
              color: #333;
              margin-bottom: 20px;
            }

            .message {
              margin-bottom: 10px;
              max-width: 70%;
              word-wrap: break-word;
            }

            .user-message {
              align-self: flex-end;
              background-color: #dcf8c6;
              border-radius: 20px;
              padding: 10px;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }

            .assistant-message {
              align-self: flex-start;
              background-color: #e5e5ea;
              border-radius: 20px;
              padding: 10px;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }

            .form-container {
              display: flex;
              margin-top: 20px;
              width: 100%;
              max-width: 500px;
            }

            .form-input {
              flex: 1;
              padding: 8px;
              border-radius: 10px 10px 10px 10px;
              border: 1px solid #ccc;
              font-size: 16px;
            }

            .form-button {
              padding: 10px 20px;
              border-radius: 0 5px 5px 0;
              border: none;
              background-color: #4caf50;
              color: #fff;
              cursor: pointer;
              font-size: 16px;
              font-weight: bold;
            }
</style>


<div class="container-1">
<h3 class="text-gray-800">CHAT GPT 3.5-Turbo</h3>
<?php
        $OPENAI_API_KEY = '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';

        function generateChatResponse($message) {
            global $OPENAI_API_KEY;

            $url = 'https://api.openai.com/v1/chat/completions';
            
            $data = array(
                'model' => 'gpt-3.5-turbo',
                'messages' => array(
                    array('role' => 'user', 'content' => $message)
                )
            );
            
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $OPENAI_API_KEY,
                'OpenAI-Organization: org-r32saQ3K46g0BPC367h94WjF'
            );
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            
            $response = curl_exec($ch);
            // echo "Response: " . $response; Tambahkan baris ini
            curl_close($ch);
            
            $responseData = json_decode($response, true);
            
            $reply = $responseData['choices'][0]['message']['content'];
            
            return $reply;
        }

        // Mengganti "nama_pengguna" dengan data pengguna yang sesuai dari database
        $nama_pengguna = $nama_pengguna;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
            $userMessage = $_POST['message'];
            $reply = generateChatResponse($userMessage);

            echo '<div class="message user-message">';
            echo '<strong>' . $nama_pengguna . ':</strong> ' . htmlspecialchars($userMessage);
            echo '</div>';

            echo '<div class="message assistant-message">';
            echo '<strong>ChatGPT: </strong> ' . htmlspecialchars($reply);
            echo '</div>';
        }
?>
  
        <form method="post" action="">
            <div class="form-container">
                <input type="text" name="message" class="form-input" placeholder="Ketik Pertanyaan Anda..." autocomplete="off">
                <button type="submit" class="form-button ml-2">Send</button>
            </div>
        </form>
    </div>
<p></p>
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

  <!-- Logout Coming Soon-->
  <div class="modal fade" id="comingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Coming Soon</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Fitur ini masih belum aktif</div>
        <div class="modal-footer">
        <button class="btn btn-primary" type="button" data-dismiss="modal">Oke</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih Logout untuk keluar</div>
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

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
