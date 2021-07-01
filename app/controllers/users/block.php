<?php

require 'app/controllers/users/userClass.php';

$users = new AllUser;
$users->blockUsers($block);

