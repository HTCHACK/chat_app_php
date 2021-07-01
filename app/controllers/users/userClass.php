<?php

class AllUser
{
    public function index($users)
    {   
        include 'database/dbConn.php';
        $users = $db->query("SELECT * FROM login");
        require 'resources/views/users/index.view.php';
        
    }

    public function blockUsers($block)
    {
        include 'database/dbConn.php';
        $block = $conn->query("SELECT * FROM login");
        require 'resources/views/users/block.view.php';
    }
}