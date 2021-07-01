<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location:/login");
}
require 'app/controllers/chat/chatClass.php';

$new = new Chat;

$new->store();

