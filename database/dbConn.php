<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "online_chat";


$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}



