<?php
include('../includes/connection.php');
?>
<style>
    .scale {
        height: 100%;
        width: 100%;
        text-align: center;
    }
</style>
<script src="../vendor/chart.js/Chart.min.js"></script>

  <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin 2 - Tables</title>

        <!-- Custom fonts for this template -->
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    </head>
    <?php
// include('../includes/navbar_top.php');
?>
    <body id="page-top">
        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <div class="container-fluid"><br>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <?php
                                $stmt = $pdo->query(" SELECT count(*) FROM `school` ");
                                while ($row = $stmt->fetch()) {
                                    $sumschool = $row['count(*)'];
                                }

                                ?>
                                <h6 class="m-0 font-weight-bold text-primary">All <?php echo $sumschool; ?> Schools </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>School</th>
                                                <th>Result</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>School</th>
                                                <th>Result</th>

                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $stmt = $pdo->query("SELECT `school`.*, COUNT(`school_name`), COUNT(`quartile_id`)  FROM `school` 
                                                        LEFT JOIN `article` ON `article`.`school_name` = `school`.`id` GROUP BY `school`.`id`");
                                            while ($row = $stmt->fetch()) {
                                                echo " <tr>";
                                                echo "<td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["COUNT(`school_name`)"] . " เรี่อง</td>";
                                                echo " </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

<div class="scale">
    <canvas id="piechart"></canvas>

    <?php
    
    $datesave = array();
    $ptotal = array();

    $stmt = $pdo->query("SELECT `school`.*, COUNT(`school_name`), COUNT(`quartile_id`)  FROM `school` 
LEFT JOIN `article` ON `article`.`school_name` = `school`.`id` GROUP BY `school`.`id` ");

    while ($rs = $stmt->fetch()) {
        $datesave[] = "\"" . $rs["name"] . "\"";
        $ptotal[] = "\"" . $rs["COUNT(`school_name`)"] . "\"";
    }
    $datesave = implode(",", $datesave);
    $ptotal = implode(",", $ptotal);

    ?>

    <script type="text/javascript">
        // Pie Chart Example
        var ctx = document.getElementById("piechart");
        var piechart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [<?php echo $datesave; ?>],
                datasets: [{
                    data: [<?php echo $ptotal; ?>],
                    backgroundColor: ['#3B33FF', '#33E5FF', '#33FFBB', '#33FF7F', '#46FF33', '#8EFF33', '#E1FF33', '#FFDD33', '#FFA133', '#FF7B33', '#FF6433', '#9D33FF', '#CA33FF', '#F433FF', '#FF33D5', '#FF33B0', '#FF3377', '#9D33FF', ],
                    hoverBackgroundColor: ['#3B33FF', '#33E5FF', '#33FFBB', '#33FF7F', '#46FF33', '#8EFF33', '#E1FF33', '#FFDD33', '#FFA133', '#FF7B33', '#FF6433', '#9D33FF', '#CA33FF', '#F433FF', '#FF33D5', '#FF33B0', '#FF3377', '#9D33FF'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    caretPadding: 10,
                },
                legend: {
                    display: true
                },
                cutoutPercentage: 50,
            },
        });
    </script>
    <?php
    // include('../chart-pie-list.php')
    // include('../includes/head.php')
    ?>
  
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    </body>

    </html>