<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
if (isset($_SESSION["login"])) {
    header("Location: ./");
}

require 'koneksi.php';

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM admin WHERE email ='$email'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row["password"]) {
            $_SESSION["login"] = true;
            $id = $row["id_admin"];
            $_SESSION['admin_id'] = $row["id_admin"];

            // Set session message
            $_SESSION['pesan_success'] = "Selamat datang, Anda berhasil login.";

            // Update last login time
            $update_last_login_query = "UPDATE admin SET last_login = NOW() WHERE id_admin = $id";
            mysqli_query($koneksi, $update_last_login_query);

            header("Location: ./");
            exit;
        }
    }

    $error = true;
    $pesan_error = "Kata sandi yang Anda masukkan salah. Silakan coba lagi.";
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="css-second/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="Assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Favicon/icons8-synchronize-310.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Favicon/icons8-synchronize-310.png">
    <link rel="manifest" href="Assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="Favicon/icons8-synchronize-310.png" color="#5bbad5">
    <link rel="shortcut icon" href="Favicon/icons8-synchronize-310.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .alert {
            margin-top: 10px;
            padding: 15px;
            border: 1px solid transparent;
            border-radius: 4px;
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
        <form action="" method="post">
				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		<input type="email" name="email" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input">
            	   </div>
            	</div>
            	<input type="submit" class="btn" name="login" value="Login">
                <?php if(isset($error) && $error == true): ?>
                <div class="alert alert-danger"><?php echo $pesan_error; ?></div>
                        <?php endif; ?>
                <a href="../Sign-In/" type="link" class="btn btn-secondary" style="line-height: 2.5;"><center>Kembali ke Home</center></a>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>