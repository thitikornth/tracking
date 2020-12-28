<?php
session_start();
include('includes/connection.php');

$date_log = date('Y/m/d H:i:s', strtotime('+6 hour'));
$topic = 'Logged out';

if (isset($_SESSION['users_username'])) {
   $sql = "INSERT INTO `log_login` (`log_id`, `log_time`, `log_topic`, `log_username`) 
    VALUES (NULL, '$date_log', '$topic', '" . $_SESSION['users_username'] . "');";

   $stmt = $pdo->prepare($sql);
   $stmt->execute(array());
} else if (isset($_SESSION['admin_username'])) {
   $sql = "INSERT INTO `log_login` (`log_id`, `log_time`, `log_topic`, `log_username`) 
      VALUES (NULL, '$date_log', '$topic', '" . $_SESSION['admin_username'] . "');";

   $stmt = $pdo->prepare($sql);
   $stmt->execute(array());
}

session_destroy();

include('includes/script.php');

echo '<script type="text/javascript">
    swal.fire("Successfully logged out ", "SUCCESS", "success");
    </script>';
if (isset($_GET['logout'])) {
   echo "<meta http-equiv='Refresh' content='0.7; url=../index.php'>";
} else {
   echo "<meta http-equiv='Refresh' content='0.7; url=index.php'>";
}
?>