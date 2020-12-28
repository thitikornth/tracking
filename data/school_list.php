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
                            <th>No.</th>
                            <th>Schools</th>
                            <th>Results</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Schools</th>
                            <th>Results</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT `school`.*, COUNT(`school_name`) FROM `school` 
                                                        LEFT JOIN `article` ON `article`.`school_name` = `school`.`id` GROUP BY `school`.`id`");
                        while ($row = $stmt->fetch()) {
                            echo " <tr>";
                            echo "<td>" . $row["id"] . "</td><td>" . $row["school_name_eng"]." (".$row["school_initial"].")" . "</td><td>" . $row["COUNT(`school_name`)"] . " Article</td>";
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

