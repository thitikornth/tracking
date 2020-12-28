<?php
session_start();
include('includes/head.php');
include('includes/connection.php');

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
            $message_success = '<label>Login Success</label>';
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


<!DOCTYPE html>
<html lang="th">

<head>
    <title>Login</title>
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
</head>

<body class="body-admin-login">
    <h1 class="text-head"> ADMIN Login </h1>
    <div class=" w3l-login-form">
        <form class="user" method="POST">
            <div class=" w3l-form-group">
                <?php
                if (isset($message)) {
                    echo '<center><label class="btn btn-outline-danger d-lg-inline ">' . $message . '</label></center>';
                }
               
                if (isset($message_success)) {
                    echo '<center><label class="btn btn-outline-success d-lg-inline ">' . $message_success . '</label></center>';
                }
                ?>
                <label><b>Username:</label>
                <div class="group-admin-login">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" name="admin_username" placeholder="Username" required>
                </div>
            </div>
            <div class=" w3l-form-group">
                <label>Password:</label>
                <div class="group-admin-login">
                    <i class="fas fa-unlock"></i>
                    <input type="password" class="form-control" name="admin_password" placeholder="Password" required>
                </div>
            </div>


            <button type="button" class="button-admin-login" data-toggle="modal" data-target="#exampleModalCenter">
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
</body>

</html>
<?php
include('includes/script.php');
?>