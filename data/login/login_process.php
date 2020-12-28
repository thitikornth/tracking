<?php
session_start();
include('includes/connection.php');
if (isset($_POST["login"])) {
    if (empty($_POST["admin_username"]) || empty($_POST["admin_password"])) {
        $message = '<label>All fields are required</label>';
    } else {
        //  Start login admin
        $query = "SELECT * FROM admin WHERE admin_username = :admin_username AND admin_password = :admin_password";
        $statement = $pdo->prepare($query);
        $statement->execute(
            array(
                'admin_username'             =>     $_POST["admin_username"],
                'admin_password'    =>     $_POST["admin_password"]
            )
        );
        $count = $statement->rowCount();

        if ($count > 0) {
            $_SESSION["admin_username"] = $_POST["admin_username"];
            header("location:login_success.php");
        } else {
            $message = '<label>Wrong password</label>';
        }
        //  Close login admin
    }
}
session_destroy();
?>
