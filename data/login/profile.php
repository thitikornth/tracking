<?php
session_start();
include('includes/head.php');
include('includes/navbar_side.php');
include('includes/navbar_top.php');
include('includes/connection.php');
?>

<body class="bg-gradient-primary">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row1">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Profile </h1>
                                </div>
                                
                                <?php

                               
                                $stmt = $pdo->query("SELECT COUNT(*) FROM article WHERE '" . $_SESSION['users_id'] . "' ");
                                while ($row = $stmt->fetch()) {
                                    $_SESSION['users_count_article'] = $row["COUNT(*)"];
                                }
                                $stmt = $pdo->query("SELECT `users`.*, `ct_ex`.*, `school`.* FROM `users` 
                                                    LEFT JOIN `ct_ex` ON `users`.`id_ct_ex` = `ct_ex`.`id`
                                                    LEFT JOIN `school` ON `users`.`id_school` = `school`.`id` WHERE `users`.`id` = '" . $_SESSION['users_id'] . "' ");
                                while ($row = $stmt->fetch()) {
                                    $_SESSION['first_name'] = $row["first_name"];
                                    $_SESSION['last_name'] = $row["last_name"];
                                    $_SESSION['ct_ex_name_eng'] = $row["ct_ex_name_eng"];
                                    $_SESSION['school'] = $row["school_name_eng"];
                                }
                                ?>

                                <form class="insert-form" action="../tracking_table_user.php" method="get">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <span><b>Firstname : &nbsp</b></span>
                                            <input style="width: 100%;" type="text" class="form-control-plaintext" value="<?php echo $_SESSION['first_name']; ?>" name="title" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <span><b>Lastname : &nbsp</b></span>
                                            <input style="width: 100%;" type="text" class="form-control-plaintext" value="<?php echo $_SESSION['last_name']; ?>" name="author" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <span><b>Center of Excellence : &nbsp</b></span>
                                            <textarea style="width: 100%;" type="text" class="form-control-plaintext" name="title" readonly required><?php echo $_SESSION['ct_ex_name_eng']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <span><b>School of : &nbsp</b></span>
                                            <input style="width: 100%;" type="text" class="form-control-plaintext" value="<?php echo $_SESSION['school']; ?>" name="vol" readonly required>
                                        </div>
                                    </div>
                                </form>
                                <hr>

                                <?php
                                $stmt = $pdo->query("SELECT COUNT(*) FROM `tracking` WHERE `id_users` = '" . $_SESSION['users_id'] . "' AND `id_tracking_status` = '1'");
                                while ($row = $stmt->fetch()) {
                                    $_SESSION['users_count_tracking_onprocess'] = $row["COUNT(*)"];
                                }

                                $stmt = $pdo->query("SELECT COUNT(*) FROM `tracking` WHERE `id_users` = '" . $_SESSION['users_id'] . "' AND `id_tracking_status` = '2'");
                                while ($row = $stmt->fetch()) {
                                    $_SESSION['users_count_tracking_success'] = $row["COUNT(*)"];
                                }
                                ?>

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">All Research Article Tracking </h1>
                                </div>

                                <form class="insert-form" action="../tracking_table_user.php" method="get">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <button style="width: 100%;" class='btn btn-danger btn-user btn-block' name="users_id" value="<?php echo $_SESSION['users_id'] ?>">On
                                                Process</button>
                                            <input name="tracking_status" type="hidden" value="1">
                                            <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['users_count_tracking_onprocess'] . ' : Article'; ?>" readonly required>

                                </form>

                                <form class="insert-form" action="../tracking_table_user.php" method="get">
                            </div>
                            
                            <div class="form-group">
                                <button style="width: 100%;" class='btn btn-success btn-user btn-block' name="users_id" value="<?php echo $_SESSION['users_id'] ?>">Success</button>
                                <input name="tracking_status" type="hidden" value="2">
                                <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['users_count_tracking_success'] . ' : Article'; ?>" readonly required>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <?php
    include('includes/footer.php');
    include('includes/script.php');
    ?>