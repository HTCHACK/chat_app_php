<?php
session_start();

require 'app/controllers/home/homeClass.php';

$home = new Home;
$home->index();