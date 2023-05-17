<?php
if (isset($_POST['register'])) {
    // Mengambil nilai input dari form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Validasi input
    if (empty($email) || empty($password) || empty($password2)) {
        // Jika ada field yang kosong, tampilkan pesan error
        $error_message = "Mohon lengkapi semua field.";
    } elseif ($password != $password2) {
        // Jika password dan konfirmasi password tidak sesuai, tampilkan pesan error
        $error_message = "Password dan konfirmasi password tidak cocok.";
    } else {
        // Proses registrasi admin
        // ...

        // Tambahkan kode untuk menyimpan data admin ke database atau melakukan tindakan lainnya
        // Contoh: Simpan data admin ke dalam database menggunakan PDO
        try {
            $dsn = "mysql:host=localhost;dbname=db_absensi";
            $db_username = "root";
            $db_password = "";

            $db = new PDO($dsn, $db_username, $db_password);

            // Buat query untuk mendapatkan ID admin terakhir
            $getLastIdQuery = "SELECT MAX(id_admin) AS last_id FROM admin";
            $getLastIdStatement = $db->prepare($getLastIdQuery);
            $getLastIdStatement->execute();
            $lastIdResult = $getLastIdStatement->fetch(PDO::FETCH_ASSOC);
            $lastId = $lastIdResult['last_id'];

            // Generate ID admin baru dengan increment dari ID admin terakhir
            $newId = $lastId + 1;

            // Buat query untuk menyimpan data admin ke dalam tabel admin
            $query = "INSERT INTO admin (id_admin, email, password) VALUES (:id_admin, :email, :password)";
            $statement = $db->prepare($query);

            // Bind parameter dengan nilai input
            $statement->bindParam(':id_admin', $newId);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $password);

            // Jalankan query
            if ($statement->execute()) {
                // Tampilkan pesan sukses jika registrasi berhasil
                $success_message = "Registrasi admin berhasil. ID Admin: " . $newId;
            } else {
                // Tampilkan pesan error jika terjadi kesalahan saat menyimpan data ke database
                $error_message = "Terjadi kesalahan saat menyimpan data ke database.";
            }
        } catch (PDOException $e) {
            // Tampilkan pesan error jika terjadi kesalahan saat menghubungkan ke database
            $error_message = "Koneksi database gagal: " . $e->getMessage();
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/style.css">
    <title>Registrasi Dosen</title>
</head>
<body class="login">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <form action="" class="panel" method="post">
                    <h3 class="mb-4 text-center text-uppercase">Registrasi Admin</h3>
                    <div class="form-group ml-5 mr-5">
                        <input type="text" name="email" id="email" class="form-control form-control-lg radius" placeholder="Email">
                    </div>
                    <div class="form-group ml-5 mr-5">
                        <input type="password" name="password" id="password" class="form-control form-control-lg radius" placeholder="Password">
                    </div>
                    <div class="form-group ml-5 mr-5">
                        <input type="password" name="password2" id="password2" class="form-control form-control-lg radius" placeholder="Konfirmasi Password">
                    </div>
                    

                    <div class="form-group mt-4 ml-5 mr-5">
                    <button type="submit" class="btn btn-info btn-login block radius" name="register">Registrasi</button>
                    </div>
                </form>

            </div>
        </div>
    </div>




    <script src="js/bootstrap.min.js" ></script>
</body>
</html>