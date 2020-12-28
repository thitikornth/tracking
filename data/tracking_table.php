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
    $date = date('Y-m-d H:i:s', strtotime("+5 hour", strtotime($_POST["date"])));
    $sql = "INSERT INTO `article` (`id`, `school_name`,`title`, `author`, `journal`, `vol`, `quartile_id`, `cite_score`, `percentle`, `pfs_m`, `pfs_wu`, `ref`, `date`, `id_users`,`id_tracking_status` ) 
        VALUES (NULL, '" . $_POST['school_name'] . "', '" . $_POST['title'] . "', '" . $_POST['author'] . "', '" . $_POST['journal'] . "', '" . $_POST['vol'] . "', '" . $_POST['quartile_id'] . "', 
               '" . $_POST['cite_score'] . "', '" . $_POST['percentle'] . "', '" . $_POST['pfs_m'] . "', '" . $_POST['pfs_wu'] . "', '" . $_POST['ref'] . "', '" . $date . "', '" . $_POST['id_users'] . "', '" . $_POST['id_tracking_status'] . "')";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());

    $stmt = $pdo->query("SELECT `article`.`id` FROM `article` ORDER BY `article`.`id` DESC LIMIT 0,1 ");
    while ($row = $stmt->fetch()) {
        $_SESSION['id_article'] = $row["id"];
    }

    $stmt = $pdo->query("SELECT * FROM `users` ");
    while ($row = $stmt->fetch()) {
        $_SESSION['id_ct_ex'] = $row["id_ct_ex"];
    }

    $sql = "INSERT INTO `tracking` (`id`, `id_users`,`id_ct_ex`, `id_article`, `id_tracking_status`, `introduction`, `methology`, `result_discussion`, `conclusion_abstract`, `submited`, `under_review`, `revision`, `accepted`,`published`,`one_to_one`, `date`) 
        VALUES (NULL, '" . $_POST['id_users'] . "', '" . $_SESSION['id_ct_ex'] . "', '" . $_SESSION['id_article'] . "', '" . $_POST['id_tracking_status'] . "', '', '', '', '', '', '', '', '', '', '', '" . $date . "')";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());

    echo '<script type="text/javascript">
        swal.fire("Fill out research articles ", "SUCCESS", "success");
        </script>';
}
?>
<?php

if (isset($_POST['form_tracking_update'])) {
    $_SESSION['id'] = $_POST['id'];
    $date = date('Y-m-d H:i:s', strtotime("+5 hour", strtotime($_POST["date"])));

    if (isset($_POST['introduction'])) {
        $sql = "UPDATE `tracking` SET `introduction` = '" . $_POST['introduction'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array());
    } else if (isset($_POST['methology'])) {
        $sql = "UPDATE `tracking` SET `methology` = '" . $_POST['methology'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array());
    } else if (isset($_POST['result_discussion'])) {
        $sql = "UPDATE `tracking` SET `result_discussion` = '" . $_POST['result_discussion'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array());
    } else if (isset($_POST['conclusion_abstract'])) {
        $sql = "UPDATE `tracking` SET `conclusion_abstract` = '" . $_POST['conclusion_abstract'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array());
    } else if (isset($_POST['submited'])) {
        $sql = "UPDATE `tracking` SET `submited` = '" . $_POST['submited'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array());
    } else if (isset($_POST['under_review'])) {
        $sql = "UPDATE `tracking` SET `under_review` = '" . $_POST['under_review'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array());
    } else if (isset($_POST['revision'])) {
        $sql = "UPDATE `tracking` SET `revision` = '" . $_POST['revision'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array());
    } else if (isset($_POST['accepted'])) {
        $sql = "UPDATE `tracking` SET `accepted` = '" . $_POST['accepted'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array());
    } else if (isset($_POST['published'])) {
        $sql = "UPDATE `tracking` SET `published` = '" . $_POST['published'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array());
    } else if (isset($_POST['one_to_one'])) {
        $_SESSION['id_tracking_status'] = '2';
        $sql = "UPDATE `tracking` SET `one_to_one` = '" . $_POST['one_to_one'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array());

        $sql = "UPDATE `tracking` SET `id_tracking_status` = '" . $_SESSION['id_tracking_status'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array());
    }

    echo '<script type="text/javascript">
        swal.fire("Tracking Research Article System ", "SUCCESS", "success");
        </script>';
}
?>

<body class="bg-gradient-primary">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?php
                $stmt = $pdo->query("SELECT COUNT(*) ,`users`.*, `school`.*,`ct_ex`.* ,`tracking`.* FROM `tracking` 
                                    LEFT JOIN `users` ON `tracking`.`id_users` = `users`.`id` 
                                    LEFT JOIN `school` ON `users`.`id_school` = `school`.`id` 
                                    LEFT JOIN `ct_ex` ON `users`.`id_ct_ex` = `ct_ex`.`id` ");
                while ($row = $stmt->fetch()) {
                    $sum_tracking = $row['COUNT(*)'];
                    $firstname =  $row['first_name'];
                    $lastname =  $row['last_name'];
                    $school =  $row['school_name_eng'];
                    $ct_ex_name =  $row['ct_ex_name'];
                }
                ?>
                <h6 class="m-0 font-weight-bold text-primary">All <?php echo $sum_tracking; ?> Research Article : Tracking Status </h6>
                <hr>
                <span> <?php echo $firstname . ' ' . $lastname; ?></span><br>
                <span> <?php echo $school; ?></span>
                <!-- <span> <?php echo 'Center of Excenllence : ' . ' ' . $ct_ex_name; ?></span> -->

                <?php
                if (isset($_POST['form_submit'])) {
                    $stmt = $pdo->query("SELECT `article`.*, `users`.*,`tracking`.* FROM `tracking` 
                                LEFT JOIN `article` ON `tracking`.`id_article` = `article`.`id` 
                                LEFT JOIN `users` ON `tracking`.`id_users` = `users`.`id` WHERE `users`.`id` = '" . $_SESSION['users_id'] . "' ORDER BY `tracking`.`id`  DESC LIMIT 0,1");
                    while ($row = $stmt->fetch()) {
                        $article = $row['title'];
                    }
                ?>
                    <span>
                        <hr>
                        <?php
                        echo "<i class = 'btn btn-success btn-user btn-block' >Title : .$article. </i>";
                        echo "<i class = 'btn btn-success btn-user btn-block' >Fill out Research Articles is Success</i>";
                        ?>
                    </span>
                <?php
                }
                ?>

                <?php
                if (isset($_POST['form_tracking_update'])) {
                    $stmt = $pdo->query("SELECT `article`.*, `users`.*,`tracking`.* FROM `tracking` 
                                LEFT JOIN `article` ON `tracking`.`id_article` = `article`.`id` 
                                LEFT JOIN `users` ON `tracking`.`id_users` = `users`.`id` ORDER BY `tracking`.`id`  DESC LIMIT 0,1");
                    while ($row = $stmt->fetch()) {

                        $article = $row['title'];
                    }
                ?>
                    <span>
                        <hr>
                        <?php
                        echo "<i class = 'btn btn-success btn-user btn-block' >Title : .$article.</i>";
                        echo "<i class = 'btn btn-success btn-user btn-block' >Tracking Research Article is Success</i>";
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
                                <th>No.</th>
                                <th>Center of Excenllence</th>
                                <th>Title</th>
                                <th>Journal</th>
                                <th>Quartile</th>
                                <th>Percentile</th>
                                <th>Introduction</th>
                                <th>Methology</th>
                                <th>Result & Discussion</th>
                                <th>Conclusion & Abstract</th>
                                <th>Submited</th>
                                <th>Under_review</th>
                                <th>Revision</th>
                                <th>Accepted</th>
                                <th>Published</th>
                                <th>1:01</th>
                                <th>Process</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Center of Excenllence</th>
                                <th>Titl</th>
                                <th>Journal</th>
                                <th>Quartile</th>
                                <th>Percentile</th>
                                <th>Introduction</th>
                                <th>Methology</th>
                                <th>Result & Discussion</th>
                                <th>Conclusion & Abstract</th>
                                <th>Submited</th>
                                <th>Under_review</th>
                                <th>Revision</th>
                                <th>Accepted</th>
                                <th>Published</th>
                                <th>1:01</th>
                                <th>Process</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no = 0;
                            $ad = 1;
                            $stmt = $pdo->query("SELECT `users`.*, `ct_ex`.*, `article`.* ,`tracking_status`.`process` ,`tracking`.* ,`quartile`.`quartile` FROM `tracking` 
                                LEFT JOIN `users` ON `tracking`.`id_users` = `users`.`id` 
                                LEFT JOIN `ct_ex` ON `tracking`.`id_ct_ex` = `ct_ex`.`id`
                                LEFT JOIN `article` ON `tracking`.`id_article` = `article`.`id`
                                LEFT JOIN `tracking_status` ON `tracking`.`id_tracking_status` = `tracking_status`.`id`
                                LEFT JOIN `quartile` ON `article`.`quartile_id` = `quartile`.`id`
                                ORDER BY `tracking`.`id` DESC ");
                            while ($row = $stmt->fetch()) {
                                $c = $no += $ad;
                                // $_SESSION['id_tracking'] = $row["id"] ;
                                // $_SESSION['first_name'] = $row["first_name"] ;
                                // $_SESSION['last_name'] = $row["last_name"] ;
                                // $_SESSION['ct_ex_name'] = $row["ct_ex_name"] ;
                                // $_SESSION['title'] = $row["title"] ;
                                // $_SESSION['introduction'] = $row["introduction"] ;
                                // $_SESSION['methology'] = $row["methology"] ;
                                // $_SESSION['result_discussion'] = $row["result_discussion"] ;
                                // $_SESSION['conclusion_abstract'] = $row["conclusion_abstract"] ;
                                // $_SESSION['submited'] = $row["submited"] ;
                                // $_SESSION['under_review'] = $row["under_review"] ;
                                // $_SESSION['revision'] = $row["revision"] ;
                                // $_SESSION['accepted'] = $row["accepted"] ;
                                // $_SESSION['published'] = $row["published"] ;
                                // $_SESSION['one_to_one'] = $row["one_to_one"] ;
                                // $_SESSION['process'] = $row["process"] ;
                                // $_SESSION['id_tracking_status'] = $row["id_tracking_status"] ;
                                echo " <tr>";
                                echo "<td>" . $c . "</td><td>" . $row["ct_ex_name_eng"] . "</td><td>" . $row["title"] . "</td><td>" . $row["journal"] . "</td><td>" . $row["quartile"] . "</td><td>" . $row["percentle"] . "%</td><td>";
                                if ($row["introduction"] == 'Success') {
                                    echo "<img src='img/success.png' class='imginput'>";
                                } else {
                                    echo "<img src='img/incorrect.png' class='imginput'>";
                                };
                                echo "</td><td>";
                                if ($row["methology"] == 'Success') {
                                    echo "<img src='img/success.png' class='imginput'>";
                                } else {
                                    echo "<img src='img/incorrect.png' class='imginput'>";
                                };
                                echo "</td><td>";
                                if ($row["result_discussion"] == 'Success') {
                                    echo "<img src='img/success.png' class='imginput'>";
                                } else {
                                    echo "<img src='img/incorrect.png' class='imginput'>";
                                };
                                echo "</td><td>";
                                if ($row["conclusion_abstract"] == 'Success') {
                                    echo "<img src='img/success.png' class='imginput'>";
                                } else {
                                    echo "<img src='img/incorrect.png' class='imginput'>";
                                };
                                echo "</td><td>";
                                if ($row["submited"] == 'Success') {
                                    echo "<img src='img/success.png' class='imginput'>";
                                } else {
                                    echo "<img src='img/incorrect.png' class='imginput'>";
                                };
                                echo "</td><td>";
                                if ($row["under_review"] == 'Success') {
                                    echo "<img src='img/success.png' class='imginput'>";
                                } else {
                                    echo "<img src='img/incorrect.png' class='imginput'>";
                                };
                                echo "</td><td>";
                                if ($row["revision"] == 'Success') {
                                    echo "<img src='img/success.png' class='imginput'>";
                                } else {
                                    echo "<img src='img/incorrect.png' class='imginput'>";
                                };
                                echo "</td><td>";
                                if ($row["accepted"] == 'Success') {
                                    echo "<img src='img/success.png' class='imginput'>";
                                } else {
                                    echo "<img src='img/incorrect.png' class='imginput'>";
                                };
                                echo "</td><td>";
                                if ($row["published"] == 'Success') {
                                    echo "<img src='img/success.png' class='imginput'>";
                                } else {
                                    echo "<img src='img/incorrect.png' class='imginput'>";
                                };
                                echo "</td><td>";
                                if ($row["one_to_one"] == 'Success') {
                                    echo "<img src='img/success.png' class='imginput'>";
                                } else {
                                    echo "<img src='img/incorrect.png' class='imginput'>";
                                };
                                echo "</td><td>";
                                if ($row["process"] == 'Success') {
                                    echo "<i class = 'btn btn-success shadow-sm'>Success</i>";
                            ?>
                                    <!-- <hr> -->
                                    <!-- <form action="tracking_form.php" method="get">
                                        <input name="id" type="hidden" value="<?php echo $row['id'] ?>">
                                        <input class="btn btn-primary shadow-sm" type="submit" value="Detail">
                                    </form> -->
                                <?php
                                } else {
                                    echo "<i class = 'btn btn-danger shadow-sm'>On Process</i>";
                                ?>
                                    <hr>
                                    <!-- <form action="tracking_form.php" method="get">
                                        <input name="id" type="hidden" value="<?php echo $row['id'] ?>">
                                        <input class="btn btn-warning shadow-sm" type="submit" value="Update Now">
                                    </form>  -->
                            <?php
                                };
                                echo "</td></tr>";
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