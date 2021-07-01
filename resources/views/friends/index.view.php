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
                            <h1>Friends</h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Users Username</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Message</th>
                                                <th>Unblock</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php foreach ($users as $key => $user) : ?>
                                                <tr>
                                                    <td><?php echo $user['username'] ?>!</td>
                                                    <td><a href="" class="btn btn-info">Send <i class="fa fa-paper-plane"></i></td>
                                                    <td><a href="" class="btn btn-warning"><i class="fas fa-unlock"></i></td>
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



<?php require 'resources/views/layouts/scripts.view.php'; ?>
</body>

</html>