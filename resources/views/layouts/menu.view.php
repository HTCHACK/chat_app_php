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
            <a href="/logout" class="nav-link">Logout</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Hello <?php echo $_SESSION['username'];?> - User Id : <?php echo $_SESSION['user_id'];?></a>
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
        <img src="user-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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