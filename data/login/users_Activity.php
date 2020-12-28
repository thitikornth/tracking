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
            $stmt = $pdo->query("SELECT count(*) FROM `Article`");
            while ($row = $stmt->fetch()) {
                $sumarticle = $row['count(*)'];
            }
            ?>
            <h6 class="m-0 font-weight-bold text-primary">All <?php echo $sumarticle; ?> Article </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Date</th>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Schools</th>
                            <th>Active log</th>
                            

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>No.</th>
                            <th>Date</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Schools</th>
                            <th>Active log</th>
                           
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 0;
                        $ad = 1;
                        $stmt = $pdo->query("SELECT `school`.*, `quartile`.`quartile`, `article`.* , `users`.* FROM `article` 
                                                        LEFT JOIN `school` ON `article`.`school_name` = `school`.`id` 
                                                        LEFT JOIN `users` ON `article`.`id_users` = `users`.`id` 
                                                        LEFT JOIN `quartile` ON `article`.`quartile_id` = `quartile`.`id` 
                                                        ORDER BY `school`.`id` ASC");
                        while ($row = $stmt->fetch()) {
                            $c = $no += $ad;
                            $date_time = date("d,M Y", strtotime($row["date"]));
                            echo " <tr>";
                            echo "<td>" . $c . "</td><td>" . $date_time . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td>
                            <td>" . $row["school_name_eng"] . "</td><td>Add Research Article Title : " . $row["title"] . "</td>";
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