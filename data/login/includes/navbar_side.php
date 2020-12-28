<?php
error_reporting(error_reporting() & ~E_NOTICE);
?>

<body id="page-top">
    <div id="wrapper">


        <!-- <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-file-contract"></i>
                </div>
                <div class="sidebar-brand-text mx-3">WU-Publication Tracking & Dashboard </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="../index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <?php
            if (isset($_SESSION['admin_username'])) {
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="users_activity.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>User Active log</span></a>
                </li>

                <hr class="sidebar-divider my-0">
            <?php
            }
            ?>
            <hr class="sidebar-divider">

            <div class="sidebar-heading ">
                Tracking System
            </div>
           
            <li class="nav-item active">
                <a class="nav-link collapsed" href="../" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-clock"></i>
                    <span>Tracking</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">ADD DATA</h6>
                        <a class="collapse-item" href="../pub_form.php">Article Tracking Form</a>
                        <h6 class="collapse-header">Center of excellence</h6>
                        <a class="collapse-item" href="../tracking_ct_ex_onprocess.php">: On Process</a>
                        <a class="collapse-item" href="../tracking_ct_ex_success.php">: Publish</a>
                        <h6 class="collapse-header">Tracking System</h6>
                        <a class="collapse-item" href="../tracking_research.php">Researchers</a>
                        <a class="collapse-item" href="../tracking_table.php">Tracking Table</a>
                    </div>
                </div>
            </li>

        
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Add Data (Article)
            </div>
            <li class="nav-item">
                <a class="nav-link" href="../pub_form.php">
                    <i class="fas fa-newspaper"></i>
                    <span>Article published</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../npub_form.php">
                    <i class="fas fa-newspaper"></i>
                    <span>Article not Approved.</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Add Data (Project)
            </div>

            <li class="nav-item active">
                <a class="nav-link collapsed" href="../" data-toggle="collapse" data-target="#externalfunding" aria-expanded="true" aria-controls="externalfunding">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>External funding</span>
                </a>
                <div id="externalfunding" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">External funding</h6>
                        <a class="collapse-item" href="../pj_ex_form.php">Fill out data</a>
                        <a class="collapse-item" href="../pj_ex_table.php">Table</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pj_ex_form.php">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Internal funding</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul> -->