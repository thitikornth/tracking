<?php
include('includes/head.php');
include('includes/navbar_side.php');
include('includes/navbar_top.php');
include('includes/connection.php');

?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php
            $stmt = $pdo->query("SELECT COUNT(*) FROM `users`");
            while ($row = $stmt->fetch()) {
                $sum_users = $row['COUNT(*)'];
            }
            ?>
            <h6 class="m-0 font-weight-bold text-primary"> <?php echo $sum_users; ?> : Researcher</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>School</th>
                            <th>Major</th>
                            <!-- <th>Profile</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>School</th>
                            <th>Major</th>
                            <!-- <th>Profile</th> -->
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 0;
                        $ad = 1;
                        $stmt = $pdo->query("SELECT `users`.*, `school`.*, `major`.* FROM `users` 
                                            LEFT JOIN `school` ON `school`.`id` = `users`.`id_school`
                                            LEFT JOIN `major` ON `major`.`id` = `users`.`id_major` ");
                        while ($row = $stmt->fetch()) {
                            $c = $no += $ad;
                            echo " <tr>";
                            echo "<td>" . $c . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["name"] . "</td><td>" . $row["major_name"] . "</td>";
                        ?>
                            <!-- <td>
                                <form action='login/profile.php' method="get">
                                    <input type='hidden' class="btn btn-warning" name='id_profile' value="<?php echo $row['id'] ?>">
                                    <input type='hidden' class="btn btn-warning" name='id_profile' value="<?php echo $row['first_name'] ?>">
                                    <input type='hidden' class="btn btn-warning" name='id_profile' value="<?php echo $row['last_name'] ?>">
                                    <input type='hidden' class="btn btn-warning" name='id_profile' value="<?php echo $row['name'] ?>">
                                    <input type='hidden' class="btn btn-warning" name='id_profile' value="<?php echo $row['major_name'] ?>">
                                    <input type='submit' class="btn btn-warning" name='researcher_submit'>
                                </form>

                            </td> -->
                            <!-- <form action="tracking_research_ct_ex.php" method="get">
                                         <input name="id" type="hidden" value="<?php echo $row['id'] ?>">
                                         <input class="btn btn-warning shadow-sm" type="submit" value="See More">

                                    </form> -->
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