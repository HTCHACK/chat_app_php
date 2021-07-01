<?php

include 'database/pdo.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("location:/login");
}
$id = $_GET['id'];
$user = $_SESSION['user_id'];


$conn = mysqli_connect("127.0.0.1", "root", "", "online_chat");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM chat_message where to_user_id='$id' AND from_user_id='$user' or to_user_id='$user' AND from_user_id='$id'";
$message = mysqli_query($conn, $sql);



?>
<!doctype html>
<html lang="rn">

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/public/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="/public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="/public/assets/plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/public/assets/dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="/public/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="/public/assets/plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="/public/assets/plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="/public/assets/css/main.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">


    <div class="wrapper">

        <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Home</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="/login" class="nav-link">Logout</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link"><?php echo $_SESSION['username']; ?>! User_id<?php echo $user; ?></a>
        </li>


    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>


<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="/user-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <?php
        function active($currect_page)
        {
            $url_array =  explode('/', $_SERVER['REQUEST_URI']);
            $url = end($url_array);
            if ($currect_page == $url) {
                echo 'active'; //class name in css 
            }
        }
        ?>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                
                <li class="nav-item">
                    <a href="/block-friends" class="nav-link <?php active('block-friends',); ?>">
                        <i class="nav-icon fas fa-user-lock"></i>
                        <p>
                            Block Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/users" class="nav-link <?php active('users'); ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Friends <br><?php echo var_dump("from user id - "  . $user . "; to user id - " . $id); ?></h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- /.col -->

                        <section class="col-lg-8 connectedSortable" >
                            <div class="card direct-chat direct-chat-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Message to User Id =  <?php echo $_GET['id']; ?> <strong>From <?php echo $_SESSION['username']; ?> </strong></h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" >
                                <div class="direct-chat-messages" >
                            
    <!-- Message. Default to the left -->
  
                                <?php if ($message->num_rows > 0) : ?>
                                <?php while ($data = mysqli_fetch_array($message)) : ?>
            <!-- Message to the right -->
                                <?php if ($data['to_user_id'] == $_SESSION['user_id'] AND $data['from_user_id'] == $id) : ?>
                                 <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-right">user_id = <?php echo $_GET['id']; ?></span>
                                    <span class="direct-chat-timestamp float-left"><?= $data['timestamp']?></span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="/user-logo.png" alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    <?= $data['chat_message']?>
                                </div>
                                <!-- /.direct-chat-text -->
                                </div>
                                <?php endif; ?>
                                <?php if ($data['from_user_id'] == $_SESSION['user_id'] AND $data['to_user_id'] == $id) : ?>
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left"><?php echo $_SESSION['username']; ?></span>
                                        <span class="direct-chat-timestamp float-right"><?= $data['timestamp']?></span>
                                    </div>
                                    <!-- /.direct-chat-infos -->
                                    <img class="direct-chat-img" src="/user-logo.png" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        <?= $data['chat_message']?>
                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div>
                                <?php endif; ?>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                                    
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <form action="/chat" method="post">
                                        <div class="input-group">
                                            <input type="hidden" name="to_user_id" value="<?php echo $_GET['id']; ?>">
                                            <input type="hidden" name="from_user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                            <input type="text" name="chat_message" placeholder="Type Message ..." class="form-control"/>
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                        </section>

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
        </div>

    </div>

</body>

<!-- jQuery -->
<script src="/public/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)

</script>
<!-- Bootstrap 4 -->
<script src="/public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/public/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/public/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/public/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/public/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/public/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/public/assets/plugins/moment/moment.min.js"></script>
<script src="/public/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/public/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/public/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/public/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/public/assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/public/assets/dist/js/pages/dashboard.js"></script>

</body>

</html>