
<?php
error_reporting(error_reporting() & ~E_NOTICE);
if (isset($_SESSION['users_username'])) {
    $date = date('Y/m/d H:i:s', strtotime('+6 hour'));
    $topic = 'Login successfully';

    $sql = "INSERT INTO `log_login` (`log_id`, `log_time`, `log_topic`, `log_username`) 
    VALUES (NULL, '$date', '$topic', '" . $_SESSION['users_username'] . "');";


    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());

    // include('includes/script.php');


    echo '<script type="text/javascript">
        swal.fire("Login successfully", "SUCCESS", "success");
        </script>';



    echo "<meta http-equiv='Refresh' content='0.7; url=../index.php'>";
    // header("location:../index.php?=" . $_SESSION["users_username"]);
} else if ($_SESSION['admin_username'] == 'Administrator') {
    $date = date('Y/m/d H:i:s', strtotime('+6 hour'));
    $topic = 'Login successfully';

    $sql = "INSERT INTO `log_login` (`log_id`, `log_time`, `log_topic`, `log_username`) 
    VALUES (NULL, '$date', '$topic', '" . $_SESSION['admin_username'] . "');";


    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());

    // include('includes/script.php');


    echo '<script type="text/javascript">
        swal.fire("Login successfully", "SUCCESS", "success");
        </script>';

    echo "<meta http-equiv='Refresh' content='0.7; url=../index.php'>";
}


?> 
 