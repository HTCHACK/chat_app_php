<?php



$router->define([

    'login'=>'resources/views/auth/login.view.php',
    'register'=>'resources/views/auth/register.view.php',
    ''=>'app/controllers/home/index.php',        
    'validate'=>'app/controllers/login/validate.php',
    'logout'=>'app/controllers/login/logout.php',
    'store'=>'app/controllers/login/store.php',
    'users'=>'app/controllers/users/index.php',
    'block-friends'=>'app/controllers/friends/index.php',
    'chat'=>'app/controllers/chat/store.php',
]);