<?php 
session_start();

if (isset($_SESSION['admin_id'])) {
include "db_conn.php";
include 'php/User.php';

$user = getUserById($_SESSION['admin_id'], $conn);

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Profile</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="apple-touch-icon" sizes="180x180" href="../Assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Favicon/icons8-synchronize-310.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Favicon/icons8-synchronize-310.png">
    <link rel="manifest" href="../Assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="../Favicon/icons8-synchronize-310.png" color="#5bbad5">
    <link rel="shortcut icon" href="Favicon/icons8-synchronize-310.png">
</head>
<body>
    <?php if ($user) { ?>

    <div class="d-flex justify-content-center align-items-center vh-100">
        
        <form class="shadow w-450 p-3" 
              action="php/edit.php" 
              method="post"
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
                   name="nama_pengguna_admin"
                   value="<?php echo $user['nama_pengguna_admin']?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" 
                   class="form-control"
                   name="email"
                   value="<?php echo $user['email']?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" name="password" value="<?php echo $user['password']?>">
              <button class="btn btn-outline-secondary" type="button" id="show-password-btn">Show</button>
            </div>
          </div>



          <div class="mb-3">
            <label class="form-label">Profile Picture</label>
            <input type="file" class="form-control mb-2" name="image">
            <img src="uploads/<?=$user['image']?>" class="rounded-circle" style="width: 70px">
            <input type="text" hidden="hidden" name="old_image" value="<?=$user['image']?>" >
          </div>
          
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="./" class="btn btn-secondary">Home</a>
        </form>
    </div>
    <?php }else{ 
        header("Location: home.php");
        exit;

    } ?>

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

<?php }else {
	header("Location: /");
	exit;
} ?>