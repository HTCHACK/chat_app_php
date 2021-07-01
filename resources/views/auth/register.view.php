<?php

include 'database/pdo.php';

session_start();

$message = '';

if(isset($_SESSION['user_id']))
{
	header('location:/');
}

if(isset($_POST["register"]))
{
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$check_query = "
	SELECT * FROM login 
	WHERE username = :username
	";
	$statement = $pdo->prepare($check_query);
	$check_data = array(
		':username'		=>	$username
	);
	if($statement->execute($check_data))	
	{
		if($statement->rowCount() > 0)
		{
			$message .= '<p><label>Username already taken</label></p>';
		}
		else
		{
			if(empty($username))
			{
				$message .= '<p><label>Username is required</label></p>';
			}
			if(empty($password))
			{
				$message .= '<p><label>Password is required</label></p>';
			}
			else
			{
				if($password != $_POST['confirm_password'])
				{
					$message .= '<p><label>Password not match</label></p>';
				}
			}
			if($message == '')
			{
				$data = array(
					':username'		=>	$username,
					':password'		=>	password_hash($password, PASSWORD_DEFAULT)
				);

				$query = "
				INSERT INTO login 
				(username, password) 
				VALUES (:username, :password)
				";
				$statement = $pdo->prepare($query);
				if($statement->execute($data))
				{
					$message = "<label>Registration Completed</label>";
				}
			}
		}
	}
}

?>

<!doctype html>
<html lang="rn">

<head>
    <?php require 'resources/views/layouts/head.view.php'; ?>
</head>

<body class="hold-transition login-page">


    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Online</b>Chat</a>
        </div>
        
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Login Account or <a href="/login">Login</a></p>

                    <form method="post">
                        <?php if (isset($_SESSION['message'])) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                                ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
						<div class="input-group mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['message'])) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                                ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
						<div class="input-group mb-3">
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block" name="register">Sign Up</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>


                </div>
                <!-- /.login-card-body -->
            </div>
    </div>

</body>



<?php require 'resources/views/layouts/scripts.view.php'; ?>
</body>

</html>