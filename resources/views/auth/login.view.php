<?php

include 'database/pdo.php';

session_start();


if(isset($_SESSION['user_id']))
{
	header('location:/');
}

if(isset($_POST['login']))
{
	$query = "
		SELECT * FROM login 
  		WHERE username = :username
	";
	$statement = $pdo->prepare($query);
	$statement->execute(
		array(
			':username' => $_POST["username"]
		)
	);	
	$count = $statement->rowCount();
	if($count > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if(password_verify($_POST["password"], $row["password"]))
			{
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				$sub_query = "
				INSERT INTO login_details 
	     		(user_id) 
	     		VALUES ('".$row['user_id']."')
				";
				//$statement = $pdo->prepare($sub_query);
				//$statement->execute();
				//$_SESSION['login_details_id'] = $pdo->lastInsertId();
				header('location:/');
			}
			else
			{
				$_SESSION['message'] = '<label>Wrong Password</label>';
                header('location:/login');
			}
		}
	}
	else
	{
		$_SESSION['message'] = '<label>Wrong Username</labe>';
        header('location:/login');
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
        <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Login Account or <a href="/register">Register</a></p>

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
                                <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
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