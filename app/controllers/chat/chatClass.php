<?php


class Chat
{

    public function index()
    {
        require 'app/controllers/chat/chat.php';
    }

    public function store()
    {
        //include 'database/dbConn.php';

        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("location:/login");
        } else {
            include 'database/dbConn.php';

            $to_user_id = $_REQUEST['to_user_id'];
            $chat_message = $_REQUEST['chat_message'];
            $from_user_id = $_REQUEST['from_user_id'];

            $sql = "INSERT INTO chat_message (to_user_id,chat_message,from_user_id) VALUES ('$to_user_id','$chat_message','$from_user_id')";
            //die(var_dump($sql));

            if ($db->query($sql) === TRUE) {
                $_SESSION['send'] = 'Message Send Successfully';
                header('location:/users');
            } else {
                echo "Error: " . $sql . "<br>" . $db->error;
            }

            $db->close();
        }
    }

    
}
