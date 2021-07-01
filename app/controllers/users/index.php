<?php

require 'app/controllers/users/userClass.php';

$users = new AllUser;
$users->index($users);

