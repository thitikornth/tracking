<?php
include('includes/head.php');
include('includes/connection.php');
?>

<center>

    <body>

        <?php
        echo $_POST['date'];

        $stmt = $pdo->query("SELECT * FROM article WHERE date = '".$_POST['date']."' ");
        while($row = $stmt->fetch()){
            echo "<option value='" . $row["id"] . "'>" . $row["title"] . "</option>";

        }



        $date =  date('d-M-Y', strtotime('+6 hour', strtotime($_POST['date'])));
        ?>
        <hr>
        <?php

        echo $date;
        ?>


    </body>



    <?php
    include('includes/script.php')
    ?>