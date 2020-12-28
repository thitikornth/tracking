<?php
session_start();
include('includes/head.php');
include('includes/navbar_side.php') ;
include('includes/navbar_top.php');
include('includes/connection.php');
?>
<?php
if (isset($_POST['form_submit'])) {
    include('includes/connection.php');
    $pj_date = $_POST["pj_date"];
    $pj_pc_start = $_POST["pj_pc_start"];
    $pj_pc_finish = $_POST["pj_pc_finish"];

    $sql = "INSERT INTO `pj_ex` (`pj_id`, `pj_date`,`pj_topic`, `pj_person_fr`, `pj_person_nd`, `pj_budget`, `pj_m_fee`, `pj_fund_s`, `pj_id_school`, `pj_pc_start`, `pj_pc_finish`, `pj_contract_number`, `pj_partner`, `pj_target` ,`pj_note`,`pj_user_log`, `pj_date_log` ) 
        VALUES (NULL, '" . $pj_date . "', '" . $_POST['pj_topic'] . "', '" . $_POST['pj_person_fr'] . "', '" . $_POST['pj_person_nd'] . "', '" . $_POST['pj_budget'] . "', '" . $_POST['pj_m_fee'] . "', '" . $_POST['pj_fund_s'] . "', '" . $_POST['pj_id_school'] . "',
        '" . $pj_pc_start . "', '" . $pj_pc_finish . "', '" . $_POST['pj_contract_number'] . "', '" . $_POST['pj_partner'] . "', '" . $_POST['pj_target'] . "', '" . $_POST['pj_note'] . "',  '" . $_POST['pj_user_log'] . "','" . $_POST['pj_date_log'] . "' )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());

    $stmt = $pdo->query("SELECT `pj_ex`.`pj_id` FROM `pj_ex` ORDER BY `pj_ex`.`pj_id` DESC LIMIT 0,1 ");
    while ($row = $stmt->fetch()) {
        $_SESSION['pj_id'] = $row["id"];
    }
    $date_log = date('Y/m/d H:i:s', strtotime('+6 hour'));
    $topic = "Fill out Project funded by external Topic : " . $_POST['pj_topic'];

    $sql = "INSERT INTO `log_login` (`log_id`, `log_time`, `log_topic`, `log_username`) 
    VALUES (NULL, '$date_log', '$topic', '" . $_SESSION['users_username'] . "');";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());

    echo '<script type="text/javascript">
        swal.fire("Fill out research articles ", "SUCCESS", "success");
        </script>';
}
?>

<body class="bg-gradient-primary">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?php
                $stmt = $pdo->query("SELECT COUNT(*),`pj_ex`.*,`school`.* FROM `pj_ex` 
                                    LEFT JOIN `school` ON `pj_ex`.`pj_id_school` = `school`.`id`");
                while ($row = $stmt->fetch()) {
                    $sum_project = $row["COUNT(*)"];
                }

                ?>
                <h6 class="m-0 font-weight-bold text-primary">All <?php echo $sum_project; ?> Project funded by external </h6>

                <?php
                if (isset($_POST['form_submit'])) {
                    $stmt = $pdo->query("SELECT `pj_ex`.*, `users`.* FROM `pj_ex` 
                                LEFT JOIN `users` ON `pj_ex`.`pj_user_log` = `users`.`id` 
                                WHERE `users`.`id` = '" . $_SESSION['users_id'] . "' ORDER BY `pj_ex`.`pj_id`  DESC LIMIT 0,1");
                    while ($row = $stmt->fetch()) {
                        $pj_topic = $row['pj_topic'];
                    }
                ?>
                    <span>
                        <hr>
                        <?php
                        echo "<i class=\"alert alert-primary btn btn-user btn-block\" >Title : .$pj_topic. </i>";
                        echo "<i class=\"alert alert-success btn btn-user btn-block\" >Fill out Project funded by external is Success</i>";
                        ?>
                    </span>
                <?php
                }
                ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Topic</th>
                                <th>Person first</th>
                                <th>Person Second</th>
                                <th>Bbudget</th>
                                <th>Management fee</th>
                                <th>funding source</th>
                                <th>School</th>
                                <th>Process Start</th>
                                <th>Process Finish</th>
                                <th>Contract Number</th>
                                <th>Partner</th>
                                <th>Target area</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Topic</th>
                                <th>Person.first</th>
                                <th>Person.Second</th>
                                <th>Bbudget</th>
                                <th>Managementfee</th>
                                <th>funding.source</th>
                                <th>School</th>
                                <th>Process.Start</th>
                                <th>Process.Finish</th>
                                <th>Contract.Number</th>
                                <th>Partner</th>
                                <th>Target.Area</th>
                                <th>Note</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $stmt = $pdo->query("SELECT `pj_ex`.*,`school`.`school_name_eng`,`users`.* FROM `pj_ex` 
                                                LEFT JOIN `school` ON `pj_ex`.`pj_id_school` = `school`.`id`
                                                LEFT JOIN `users` ON `pj_ex`.`pj_user_log` = `users`.`id`");
                            $no = 0;
                            $ad = 1;
                            while ($row = $stmt->fetch()) {
                                $c = $no += $ad;
                                // colspan=\"2\"
                                echo " <tr>";
                                echo "<td>" . $c . "</td><td>" . $row["pj_date"] . "</td><td>" . $row["pj_topic"] . "</td><td>" . $row["pj_person_fr"] . "</td><td>" . $row["pj_person_nd"] . "</td>";
                                echo "<td>" . $row["pj_budget"] . " ฿</td><td>" . $row["pj_m_fee"] . "</td><td>" . $row["pj_fund_s"] . "</td><td>" . $row["school_name_eng"] . "</td><td>" . $row["pj_pc_start"] . "</td>";
                                echo "<td>" . $row["pj_pc_finish"] . "</td><td>" . $row["pj_contract_number"] . "</td><td>" . $row["pj_partner"] . "</td><td>" . $row["pj_target"] . "</td>";
                                echo "<td>" . $row["pj_note"] . "</td>";
                                echo "</tr>";
                            }

                            ?>
                            <!-- <form action="tracking_form.php" method="get">
                                        <input name="id" type="hidden" value="<?php echo $row['id'] ?>">
                                        <input class="btn btn-primary shadow-sm" type="submit" value="Detail">

                                    </form> -->

                            <!-- <form action="tracking_form.php" method="get">
                                        <input name="id" type="hidden" value="<?php echo $row['id'] ?>"> -->
                            <!-- <input class="btn btn-warning shadow-sm" type="submit" value="Update Now"> -->

                            <!-- <button type="button" class="btn btn-warning shadow-sm" data-toggle="modal" data-target="#exampleModalCenter">
                                            Update
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
                                                        <button type="submit" class="btn btn-success">Confirm</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('includes/footer.php');
    include('includes/script.php');
    ?>