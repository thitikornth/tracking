<?php
session_start();
include('includes/head.php');
include('includes/connection.php');
include('includes/navbar_side.php');
include('includes/navbar_top.php');


?>

<div class="container-fluid">
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4"> -->
    <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    <!-- </div> -->
    <?php
    $stmt = $pdo->query(" SELECT count(*) FROM `school` ");
    while ($row = $stmt->fetch()) {
        $sumschool = $row['count(*)'];
    }
    $stmt = $pdo->query(" SELECT count(*) FROM `article` ");
    while ($row = $stmt->fetch()) {
        $sumarticle = $row['count(*)'];
    }
    $stmt = $pdo->query(" SELECT count(*) FROM `n_article` ");
    while ($row = $stmt->fetch()) {
        $sumn_article = $row['count(*)'];
    }
    $stmt = $pdo->query(" SELECT count(*) FROM `tracking` WHERE `id_tracking_status` = 1");
    while ($row = $stmt->fetch()) {
        $sum_tracking_inprogress = $row['count(*)'];
    }
    $stmt = $pdo->query(" SELECT count(*) FROM `tracking` WHERE `id_tracking_status` = 2");
    while ($row = $stmt->fetch()) {
        $sum_tracking_success = $row['count(*)'];
    }
    ?>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                School</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sumschool; ?> </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Published Article</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sumarticle; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                On-Processes Article </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sum_tracking_inprogress; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Tracking Success Article </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> <?php echo $sum_tracking_success; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-square fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistics of all research articles
                        <?php
                        if (isset($_POST['formdate'])) {
                            $formdate = date('d-M-Y', strtotime($_POST['formdate']));
                            $todate = date('d-M-Y', strtotime($_POST['todate']));
                            echo ": <br>From : " . $formdate;
                            echo " To : " . $todate;
                        }
                        ?>
                    </h6>

                    <form action="" method="post">
                        From : &nbsp
                        <input type="date" name="formdate" class="d-none d-sm-inline-block btn btn-sm btn-light shadow-sm" required>
                        &nbsp To : &nbsp
                        <input type="date" name="todate" class="d-none d-sm-inline-block btn btn-sm btn-light shadow-sm" required>
                        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter">
                            Submit
                        </button>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="color:black" class="modal-title" id="exampleModalLongTitle"><b>The transaction confirm.</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="color:black">
                                        Do you want to continue the transaction?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button class="btn btn-success" name="submit">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <?php
                        include('chart/chart-bar.php');
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Published articles </h6>
                    <a href="school_list.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                        <i class="fa fa-exclamation-circle"></i> Report Table</a>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <iframe src="Chart/chart-donut.php" height="130%" width="100%" style="border:none;"></iframe>
                    </div>
                    <div class="mt-4 text-center small">

                        </span>
                        <span class="mr-2">
                        </span>
                        </span>
                        <span class="mr-2">
                        </span>
                        </span>
                        <span class="mr-2">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Research Article in Scopus Database</h6>
                </div>
                <div class="card-body">
                    <?php
                    $no = 0;
                    $ad = 1;
                    $stmt = $pdo->query("SELECT * FROM `article` ORDER BY `article`.`id` DESC limit 0,5 ");
                    while ($row = $stmt->fetch()) {
                        $c = $no += $ad;

                    ?>
                        <h4 class="small font-weight-bold"> <?php echo $c . ': Title : ' . $row["title"] . '<br> Author : ' . $row['author']; ?>
                            <span class="float-right"></span></h4>
                        <div class="progress mb-4">
                            <?php
                            if ($row["percentle"] == 100) {
                            ?>

                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $row["percentle"] . "%"; ?>" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><?php echo $row["percentle"] . "%"; ?></div>
                        </div>
                    <?php
                            } else if ($row["percentle"] >= 75) {
                    ?>
                        <div class="progress-bar progress-bar-striped  progress-bar-animated  " role="progressbar" style="width: <?php echo $row["percentle"] . "%"; ?>" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><?php echo $row["percentle"] . "%"; ?></div>
                </div>
            <?php
                            } else if ($row["percentle"] >= 50) {
            ?>
                <div class="progress-bar progress-bar-striped  progress-bar-animated bg-warning" role="progressbar" style="width: <?php echo $row["percentle"] . "%"; ?>" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><?php echo $row["percentle"] . "%"; ?></div>
            </div>
        <?php
                            } else if ($row["percentle"] >= 25) {
        ?>
            <div class="progress-bar progress-bar-striped  progress-bar-animated bg-danger" role="progressbar" style="width: <?php echo $row["percentle"] . "%"; ?>" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><?php echo $row["percentle"] . "%"; ?></div>
        </div>
    <?php
                            } else if ($row["percentle"] >= 0) {
    ?>
        <div class="progress-bar progress-bar-striped  progress-bar-animated bg-danger" role="progressbar" style="width: <?php echo $row["percentle"] . "%"; ?>" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><?php echo $row["percentle"] . "%"; ?></div>
    </div>
<?php
                            }
                        }
?>
</div>
</div>
</div>
<div class="col-lg-6 mb-4">

    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">News</h6>
        </div>
        <div class="card-body">
            <div class="text-center">
                <!-- <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 33rem;" src="img/rank8.jpg" alt=""> -->

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="img/rank8.jpg" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="img/rank1.jpg" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="img/rank3.jpg" alt="">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <!-- <p>Add some quality, svg illustrations to your project courtesy of , a
                    constantly updated collection of beautiful svg images that you can use
                    completely free and without attribution!</p> -->
        </div>
    </div>
</div>
</div>
</div>

<?php
include('includes/footer.php');
include('includes/script.php');

?>