<?php

include 'database/pdo.php';

session_start();

if(!isset($_SESSION['user_id']))
{
	header("location:/login");
}

?>
<!doctype html>
<html lang="rn">

<head>
    <?php require 'resources/views/layouts/head.view.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">


    <div class="wrapper">

        <?php require 'resources/views/layouts/menu.view.php'; ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>All Users</h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?php if (isset($_SESSION['send'])) : ?>
                        <div class="alert alert-info" role="alert">
                            <?php
                            echo $_SESSION['send'];
                            unset($_SESSION['send']);
                            ?>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Users Username -- <?php echo $_SESSION['username'];?> user_Id = <?php echo $_SESSION['user_id'];?></h3>
                                </div>
                                
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>User ID</th>
                                                <th>Message</th>
                                                <th>Block Btn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($users as $key => $user) : ?>
                                                <tr>
                                                    <td><?php echo $user['username'] ?>!</td>
                                                    <td><?php echo $user['user_id'] ?></td>

                                                    <form action="app/controllers/chat/chat.php?id=<?php echo $user['user_id'];?>" method="post">
                                                        <input type="hidden" name="from_user_id" value="<?php echo $_SESSION['user_id'];?>">
                                                        <td><button type="submit" class="btn btn-info">Send <i class="fa fa-paper-plane"></i></button></td>
                                                    </form>
                                                    <td><button type="button" class="btn btn-danger"><i class="fas fa-lock"></i></button></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tfoot>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->


                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
        </div>

    </div>

</body>

<?php mysqli_close($conn); ?>

<?php require 'resources/views/layouts/scripts.view.php'; ?>
</body>

</html>