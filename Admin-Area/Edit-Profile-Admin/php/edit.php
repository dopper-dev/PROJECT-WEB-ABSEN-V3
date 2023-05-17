<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    if (isset($_POST['nama_pengguna_admin'])) {
        include "../db_conn.php";

        $password = $_POST['password'];
        $email = $_POST['email'];
        $nama_pengguna_admin = $_POST['nama_pengguna_admin'];
        $old_image = $_POST['old_image'];
        $id = $_SESSION['admin_id'];

        if (empty($nama_pengguna_admin)) {
            $em = "User name is required";
            header("Location: ../edit.php?error=$em");
            exit;
        } else {
            if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                $img_name = $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
                $error = $_FILES['image']['error'];

                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);

                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        $new_img_name = uniqid($nama_pengguna_admin, true) . '.' . $img_ex_to_lc;
                        $img_upload_path = '../uploads/' . $new_img_name;

                        // Delete old profile pic
                        if ($old_image !== "") {
                            $old_image_des = "../uploads/$old_image";
                            if (file_exists($old_image_des) && is_writable($old_image_des)) {
                                unlink($old_image_des);
                            }
                        }

                        move_uploaded_file($tmp_name, $img_upload_path);

                        // update the Database
                        $sql = "UPDATE admin 
                                SET nama_pengguna_admin=?, email=?, password=?, image=?
                                WHERE id_admin=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$nama_pengguna_admin, $email, $password, $new_img_name, $id]);
                        $_SESSION['admin_id'] = $id;
                        header("Location: ../edit.php?success=Your account has been updated successfully");
                        exit;
                    } else {
                        $em = "You can't upload files of this type";
                        header("Location: ../edit.php?error=$em");
                        exit;
                    }
                } else {
                    $em = "Unknown error occurred!";
                    header("Location: ../edit.php?error=$em");
                    exit;
                }
            } else {
                $sql = "UPDATE admin 
                        SET nama_pengguna_admin=?, email=?,  password=?
                        WHERE id_admin=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$nama_pengguna_admin, $email, $password, $id]);

                header("Location: ../edit.php?success=Your account has been updated successfully");
                exit;
            }
        }
    } else {
        header("Location: ../edit.php?error=error");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>
