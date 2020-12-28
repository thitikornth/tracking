<?php
session_start();
include('includes/head.php');
include('includes/connection.php');
// include('includes/navbar_side.php');
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
                            <th>Schools</th>
                            <th>Article</th>
                            <th>Author</th>
                            <th>Journal</th>
                            <th>Volume</th>
                            <th>Quartile</th>
                            <th>CiteScore</th>
                            <th>Highest percentile</th>
                            <th>Type</th>
                            <!-- <th>Wu Professer </th>
                            <th>Ref</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Date</th>
                            <th>Schools</th>
                            <th>Article</th>
                            <th>Author</th>
                            <th>Journal</th>
                            <th>Volume</th>
                            <th>Quartile</th>
                            <th>CiteScore</th>
                            <th>Highest percentile</th>
                            <th>Type</th>
                            <!-- <th>Wu Professer </th>
                            <th>Ref</th> -->
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 0;
                        $ad = 1;
                        $stmt = $pdo->query("SELECT `school`.*, `quartile`.`quartile`, `article`.* FROM `article` 
                                                        LEFT JOIN `school` ON `article`.`school_name` = `school`.`id` 
                                                        LEFT JOIN `quartile` ON `article`.`quartile_id` = `quartile`.`id` 
                                                        ORDER BY `school`.`id` ASC");
                        while ($row = $stmt->fetch()) {
                            $c = $no += $ad;
                            $date_time = strtotime($row["date"]);
                            $new_date = date("d,M Y", $date_time);
                            echo " <tr>";
                            echo "<td>" . $c . "</td><td>" . $new_date . "</td><td>" . $row["school_name_eng"] . "</td><td>" . $row["title"] . "</td><td>" . $row["author"] . "</td>
                                <td>" . $row["journal"] . "</td><td>" . $row["vol"] . "</td><td>Q" . $row["quartile_id"] . "</td><td>" . $row["cite_score"] . "</td><td>";
                        ?>
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-danger bg-info" role="progressbar" style="width:<?php echo $row["percentle"] . "%"; ?>"></div>
                            </div>
                        <?php
                             echo "</td><td>" . $row["article_types"] . "</td>";
                            //  <td>" . $row["pfs_wu"] . "</td><td>" . $row["ref"] . "</td>";
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