<?php 
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

include "db_conn.php";
include 'php/User.php';
$user = getUserById($_SESSION['user_id'], $conn);


 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Profile | Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/Assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/Favicon/icons8-synchronize-310.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/Favicon/icons8-synchronize-310.png">
    <link rel="manifest" href="/Assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="/Favicon/icons8-synchronize-310.png" color="#5bbad5">
</head>
<body>
    <?php if ($user) { ?>
    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    	<div class="shadow w-350 p-3 text-center">
    		<img src="uploads/<?=$user['image']?>"
    		     class="img-fluid rounded-circle">
            <h3 class="display-4 "><?=$user['nama_pengguna']?></h3>
            <a href="edit.php" class="btn btn-primary">
            	Edit Profile
            </a>
             <a href="../logout.php" class="btn btn-warning">
                Logout
            </a>
            <a href="../" class="btn btn-secondary">
            Kembali ke Home
        </a>
		</div>
    </div>
    <?php }else { 
     header("Location: /");
     exit;
    } ?>
</body>
</html>

<?php }else {
	header("Location: /");
	exit;
} ?>