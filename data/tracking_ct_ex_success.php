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
        <h6 class="m-0 font-weight-bold text-primary">The Center of Excellence's Article <hr> <i class='btn btn-success '> Publish </i>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Center of excellence </th>
                            <th>Publish</th>
                            <!-- <th>See More</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Center of excellence </th>
                            <th>Publish</th>
                            <!-- <th>See More</th> -->
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 0;
                        $ad = 1;
                        $stmt = $pdo->query("SELECT `ct_ex`.*, COUNT(`id_tracking_status`) FROM `ct_ex` 
                                            LEFT JOIN `tracking` ON `tracking`.`id_ct_ex` = `ct_ex`.`id` 
                                            WHERE `id_tracking_status` = '2' GROUP BY `ct_ex`.`id`");
                        while ($row = $stmt->fetch()) {
                            $c = $no += $ad;
                            echo " <tr>";
                            echo "<td>" . $c . "</td><td>" . $row["ct_ex_name"] . "</td><td>" . $row["COUNT(`id_tracking_status`)"] . " Article</td>";
                        ?>
                            <form action="tracking_research_ct_ex.php" method="get">
                                <input name="id" type="hidden" value="<?php echo $row['id'] ?>">
                                <!-- <input class="btn btn-warning shadow-sm" type="submit" value="See More"> -->

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