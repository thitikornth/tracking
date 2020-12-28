<?php
session_start();
include('includes/head.php');
include('includes/connection.php');

// include('includes/connection.php');
if (isset($_POST["login"])) {
    if (empty($_POST["admin_username"]) || empty($_POST["admin_password"])) {
        echo $message = '<label>All fields are required</label>';
    } else {
        //  Start login admin

        $query = "SELECT * FROM admin WHERE admin_username = :admin_username AND admin_password = :admin_password";
        $statement = $pdo->prepare($query);
        $statement->execute(
            array(
                'admin_username'    =>     $_POST["admin_username"],
                'admin_password'    =>     $_POST["admin_password"]
            )

        );
        $count = $statement->rowCount();

        if ($count > 0) {
            $_SESSION["admin_username"] = $_POST["admin_username"];
            $stmt = $pdo->query("SELECT * FROM `admin` WHERE `admin_username` = '" . $_SESSION["admin_username"] . "' ");
            while ($row = $stmt->fetch()) {
                $_SESSION["admin_id"] = $row["admin_id"];
                $_SESSION["admin_username"] = 'Administrator';
                include('login_success.php');
            }
        } else {
            $message = '<label>Wrong password</label>';
        }
        //  Close login admin
    }
}

?>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="login">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row1">
                            <div class="p-5">
                                <?php
                                if (isset($message)) {
                                    echo '<center><label>' . $message . '</label>';
                                }
                                ?>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>
                                </div>
                                <form class="user" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="admin_username" placeholder="Enter Your Username...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="admin_password" placeholder="Password">
                                    </div>

                                    <button type="button" class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#exampleModalCenter">
                                        Login
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
                                                    <button class="btn btn-success" name="login">Confirm</button>
                                                </div>
                                            </div>
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
    // session_destroy();
    ?>