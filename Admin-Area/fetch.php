<?php
include "config.php";

$sql = "SELECT * FROM chat_messages ORDER BY created_at ASC";
$result = mysqli_query($conn, $sql);

$messages = array();

while ($row = mysqli_fetch_assoc($result)) {
  $messages[] = $row;
}

echo json_encode($messages);
?>
