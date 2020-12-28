<?php
session_start();
include('includes/head.php');
include('includes/connection.php');
include('includes/navbar_side.php');
include('includes/navbar_top.php');
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Date/Time </th>
                            <th>Topic</th>
                            <th>Log_Username</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Date/Time </th>
                            <th>Topic</th>
                            <th>Log_Username</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 0;
                        $ad = 1;
                        if (isset($_SESSION['users_username'])) {
                            $stmt = $pdo->query("SELECT `log_login`.* FROM `log_login`  WHERE `log_username` = '" . $_SESSION['users_username'] . "' ORDER BY `log_id` DESC ");
                            while ($row = $stmt->fetch()) {
                                $c = $no += $ad;
                                $log_time = strtotime($row["log_time"]);
                                $new_date = date("H:i:s d,M Y", $log_time);
                                echo " <tr>";
                                echo "<td>" . $c . "</td><td>" . $new_date . "</td><td>" . $row["log_topic"] . " </td><td>" . $row["log_username"] . "</td>";
                                echo " </tr>";
                            }
                        } else if (isset($_SESSION['admin_username'])) {
                            $stmt = $pdo->query("SELECT `log_login`.* FROM `log_login` ORDER BY `log_id` DESC ");
                            while ($row = $stmt->fetch()) {
                                $c = $no += $ad;
                                $log_time = strtotime($row["log_time"]);
                                $new_date = date("H:i:s d,M Y", $log_time);
                                echo " <tr>";
                                echo "<td>" . $c . "</td><td>" . $new_date . "</td><td>" . $row["log_topic"] . " </td><td>" . $row["log_username"] . "</td>";
                                echo " </tr>";
                            }
                        }
                        ?>
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