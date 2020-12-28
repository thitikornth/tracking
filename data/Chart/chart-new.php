<style>
    
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: "Kanit", sans-serif;
    }

    /* .chart {
        width: 100%;
        height: 100%;

    } */

    .numbers {
        margin: 0;
        padding: 0;
        width: 50px;
        height: 100%;
        float: left;
    }

    .numbers li {
        height: 100px;
        position: relative;
        bottom: 0px;
    }

    .numbers span {
        font-size: 12px;
        position: absolute;
        bottom: 0;
        right: 5px;
    }

    .bars {
        font-size: 12px;

    }

    .bars li {
        display: table-cell;
        width: 600px;
        height: 250px;
        position: relative;
    }

    .bars span {
        width: 100%;
        position: absolute;
        bottom: -30px;
    }

    .bars .bar {
        display: block;
        background: #a22fbe;
        width: 20px;
        height: 100%;
        position: absolute;
        bottom: 0;
        text-align: center;
        box-shadow: 0 0 2px 0 #56006b;
        transition: 0.5s;
        transition-property: background, box-shadow;

    }

    .bars .bar:hover {
        background: #56006b;
        box-shadow: 0 0 10px 0 #56006b;
        cursor: pointer;
    }

    .bars .bar:before {
        content: attr(data-percentage) ' pcs.';
        position: relative;
        bottom: 37px;

    }
</style>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Bar Chart</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>
   
    <!--chart start-->
    <div class="chart">
        <!-- <ul class="numbers">

            <li><span>10</span></li>
            <li><span>5</span></li>
            <li><span>0</span></li>

        </ul> -->
        <ul class="bars">
            <?php
include('../includes/connection.php');
            if (isset($_POST["formdate"])) {

                $stmt = $pdo->query("SELECT `school`.*, COUNT(`school_name`), `article`.`date` FROM `school` 
                                    LEFT JOIN `article` ON `article`.`school_name` = `school`.`id` WHERE `article`.`date` BETWEEN '" . $_POST['formdate'] . "' AND '" . $_POST["todate"] . "' GROUP BY `school`.`id`");
            } else {
                $stmt = $pdo->query("SELECT `school`.*, COUNT(`school_name`), `article`.`date` FROM `school` 
                                     LEFT JOIN `article` ON `article`.`school_name` = `school`.`id` GROUP BY `school`.`id`");
            }
            while ($row = $stmt->fetch()) {
                echo "<li><div class='bar' data-percentage=" . $row["COUNT(`school_name`)"] . "></div><span>" . $row["school_initial"] . "</span></li>";
            }
            ?>

        </ul>
    </div>
    <!--chart end-->

    <script type="text/javascript">
        $(function() {
            $('.bars li .bar').each(function(key, bar) {
                var percentage = $(this).data('percentage') * 5;
                $(this).animate({
                    'height': percentage + '%'
                }, 1000);
            });
        });
    </script>

</body>

</html>