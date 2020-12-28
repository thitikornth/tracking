<?php
//   session_start();
include('connection.php');
error_reporting(error_reporting() & ~E_NOTICE);
?>

<div id="content-wrapper" class="d-flex flex-column">

    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <ul class="navbar-nav ml-auto">

            <li li class="nav-item">
                <a class="nav-link" href="../index.php">
                    <span class="btn btn-primary d-lg-inline ">Dashboard</span></a>
            </li>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="btn btn-outline-primary"><i class="fas fa-clock"></i>
                        Tracking <i class="fas fa-caret-down "></i></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Add Data</a>
                    <a class="dropdown-item" href="../pub_form.php">
                        <i class="fas fa-align-center fa-sm fa-fw mr-2 text-gray-400"></i>
                        Data form
                    </a>
                    <a class="dropdown-item" href="../tracking_ct_ex_onprocess.php">
                        <i class="fas fa-clock fa-sm fa-fw mr-2 text-gray-400"></i>
                        On Process
                    </a>
                    <a class="dropdown-item" href="../tracking_ct_ex_success.php">
                        <i class="fas fa-calendar-check  fa-sm fa-fw mr-2 text-gray-400"></i>
                        Publish
                    </a>
                    <a class="dropdown-item" href="../tracking_research.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Researchers
                    </a>
                    <a class="dropdown-item" href="../tracking_table.php">
                        <i class="fas fa-table fa-sm fa-fw mr-2 text-gray-400"></i>
                        Tracking Table
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="btn btn-outline-primary d-lg-inline"><i class="fas fa-sticky-note"></i>
                        Article <i class="fas fa-caret-down"></i></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Data Table</a>
                    <a class="dropdown-item" href="../pub_table.php">
                        <i class="fas fa-scroll fa-sm fa-fw mr-2 text-gray-400"></i>
                        Article published
                    </a>
                    <a class="dropdown-item" href="../npub_form.php">
                        <i class="fas fa-scroll fa-sm fa-fw mr-2 text-gray-400"></i>
                        Article not Approved
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="btn btn-outline-primary d-lg-inline"><i class="fas fa-fw fa-file-alt"></i>
                        Projects <i class="fas fa-caret-down"></i></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">External funding</a>
                    <a class="dropdown-item" href="../pj_ex_form.php">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Data form
                    </a>
                    <a class="dropdown-item" href="../pj_ex_table.php">
                        <i class="fas fa-table fa-sm fa-fw mr-2 text-gray-400"></i>
                        Table
                    </a>
                    <!-- <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Internal funding</a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Data form
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-table fa-sm fa-fw mr-2 text-gray-400"></i>
                        Table
                    </a> -->
                </div>
            </li>
            <?php
            if (isset($_SESSION['admin_username'])) {
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="../login/users_activity.php">
                        <span class="btn btn-warning d-lg-inline"><i class="fas fa-fw fa-tachometer-alt"></i>
                            User Active log</span></a>
                </li>
            <?php
            }
            ?>
            <ul class="navbar-nav ml-auto">

                <?php
                if (isset($_SESSION['users_username'])) {
                ?>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="btn btn-success d-lg-inline  "><i class="fas fa-caret-down"></i>
                                <?php echo 'User : ' . $_SESSION['users_username']; ?>
                                <i class="fas fa-user-alt"></i></span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="profile.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="active_log.php">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <form action="" method="get">
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" name="logout">
                                    <i class="fas fa-list fas fa-sign-out-alt fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </li>
                    <?php
                    if (isset($_GET['logout'])) {
                        include('logout.php');
                    }
                } else if (isset($_SESSION['admin_username'])) {
                    session_start();
                    ?>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="btn btn-danger d-lg-inline "><i class="fas fa-caret-down"></i>
                                <?php echo $_SESSION['admin_username']; ?>
                                <i class="fas fa-user-alt"></i></span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                            <a class="dropdown-item" href="active_log.php">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Active Log
                            </a>
                            <form action="" method="get">
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" name="logout">
                                    <i class="fas fa-list fas fa-sign-out-alt fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </li>
                    <?php
                    if (isset($_GET['logout'])) {
                        include('logout.php');
                    }
                } else {
                    ?>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item ">
                        <a class="nav-link" href="admin_login.php">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin Only</span>
                        </a>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item ">
                        <a class="nav-link" href="login.php">
                            <i class="fas fa-list fas fa-sign-out-alt fa-fw mr-2 text-gray-400"></i>
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">User Login</span>
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
    </nav>
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong><i class="fas fa-bullhorn"></i> Announce</strong> This site is in development. If you have any problems, please contact (peepee8345@gmail.com).
    </div>