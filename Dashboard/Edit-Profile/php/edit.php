<?php  
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {



if(isset($_POST['username'])){

    include "../db_conn.php";

    $password = $_POST['password'];
    $email = $_POST['email'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $username = $_POST['username'];
    $old_image = $_POST['old_image'];
    $id = $_SESSION['user_id'];

    if (empty($username)) {
    	$em = "User name is required";
    	header("Location: ../edit.php?error=$em");
	    exit;
    }else {

      if (isset($_FILES['image']['name']) AND !empty($_FILES['image']['name'])) {
         
        
         $img_name = $_FILES['image']['name'];
         $tmp_name = $_FILES['image']['tmp_name'];
         $error = $_FILES['image']['error'];
         
         if($error === 0){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if(in_array($img_ex_to_lc, $allowed_exs)){
               $new_img_name = uniqid($username, true).'.'.$img_ex_to_lc;
               $img_upload_path = '../uploads/'.$new_img_name;
               // Delete old profile pic
               $old_image_des = "../uploads/$old_image";
               if(unlink($old_image_des)){
               	  // just deleted
               	  move_uploaded_file($tmp_name, $img_upload_path);
               }else {
                  // error or already deleted
               	  move_uploaded_file($tmp_name, $img_upload_path);
               }
               

               // update the Database
               $sql = "UPDATE users_db 
                       SET nama_pengguna=?, email=?, username=?,  password=?,  image=?
                       WHERE id=?";
               $stmt = $conn->prepare($sql);
               $stmt->execute([$nama_pengguna, $email, $username, $password, $new_img_name, $id]);
               $_SESSION['username'] = $username;
               header("Location: ../edit.php?success=Your account has been updated successfully");
                exit;
            }else {
               $em = "You can't upload files of this type";
               header("Location: ../edit.php?error=$em&$data");
               exit;
            }
         }else {
            $em = "unknown error occurred!";
            header("Location: ../edit.php?error=$em&$data");
            exit;
         }

        
      }else {
       	$sql = "UPDATE users_db 
       	        SET nama_pengguna=?, email=?, username=?,  password=?
                WHERE id=?";
       	$stmt = $conn->prepare($sql);
       	$stmt->execute([$nama_pengguna, $email, $username, $password, $id]);

       	header("Location: ../edit.php?success=Your account has been updated successfully");
   	    exit;
      }
    }


}else {
	header("Location: ../edit.php?error=error");
	exit;
}


}else {
	header("Location: login.php");
	exit;
} 

