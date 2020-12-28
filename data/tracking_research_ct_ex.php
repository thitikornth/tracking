<?php
session_start();

include('includes/head.php');
include('includes/connection.php');
include('includes/navbar_side.php');
include('includes/navbar_top.php');

?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php
            $id_ct_ex = $_GET['id'];

            $stmt = $pdo->query("SELECT * FROM `ct_ex` WHERE `ct_ex`.`id` = $id_ct_ex ");
            while ($row = $stmt->fetch()) {
                $ct_ex_name = $row['ct_ex_name'];
            }
            ?>
            <h6>Center of excellence </h6>
            <hr>
            <h6 class="m-0 font-weight-bold text-primary"> <?php echo $ct_ex_name; ?> </h6>


        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Center of excellence </th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <!-- <th>Tracking</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Center of excellence </th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <!-- <th>Tracking</th> -->
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 0;
                        $ad = 1;
                        $stmt = $pdo->query("SELECT `users`.*, `ct_ex`.* FROM `users` 
                                            LEFT JOIN `ct_ex` ON `ct_ex`.`id` = `users`.`id_ct_ex` WHERE `id_ct_ex` = $id_ct_ex ");
                        while ($row = $stmt->fetch()) {
                            $c = $no += $ad;
                            // $_SESSION["id_users"] = $row["user"]
                            echo " <tr>";
                            echo "<td>" . $c . "</td><td>" . $row["ct_ex_name"] . "</td><td>" . $row["first_name"] . " </td><td>" . $row["last_name"] . " </td>";
                            // echo "<td>";
                        ?>
                            <form action="tracking_table_user.php" method="get">
                                <input name="id" type="hidden" value="<?php echo $_SESSION["users_id"] ?>">
                                <!-- <input class="btn btn-primary shadow-sm" type="submit" value="Tracking"> -->
                            </form>
                        <?php
                            // echo "</td>";
                            echo " </tr>";
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