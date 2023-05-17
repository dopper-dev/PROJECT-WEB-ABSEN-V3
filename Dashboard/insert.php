<?php
include "config.php";

$sender = $_POST["sender"];
$message = $_POST["message"];

$sql = "INSERT INTO chat_messages (sender, message) VALUES ('$sender', '$message')";

if (mysqli_query($conn, $sql)) {
echo "Pesan berhasil dikirim";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
