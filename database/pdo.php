<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "online_chat";

try {
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}

$sql = "SELECT * FROM login";
$users = $pdo->prepare($sql);
$users->execute();

// $sql2 = "SELECT * FROM chat_message where to_user_id='$id' AND from_user_id='$user'";
// $messages = $pdo->prepare($sql2);
// $messages->execute();


