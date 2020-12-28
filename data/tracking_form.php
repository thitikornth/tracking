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
                                    <h1 class="h4 text-gray-900 mb-4">ระบบติดตามบทความวิจัย (Tracking Research Article
                                        System)</h1>
                                </div>
                                <?php
                                $tracking = $_GET['id'];
                                //  echo $tracking ;
                                $stmt = $pdo->query("SELECT `users`.*, `ct_ex`.`ct_ex_name`, `article`.`title` ,`tracking_status`.`process` ,`tracking`.* FROM `tracking` 
                                                        LEFT JOIN `users` ON `tracking`.`id_users` = `users`.`id` 
                                                        LEFT JOIN `ct_ex` ON `tracking`.`id_ct_ex` = `ct_ex`.`id`
                                                        LEFT JOIN `article` ON `tracking`.`id_article` = `article`.`id`
                                                        LEFT JOIN `tracking_status` ON `tracking`.`id_tracking_status` = `tracking_status`.`id` WHERE `tracking`.`id` = $tracking ");
                                while ($row = $stmt->fetch()) {
                                    $_SESSION['id_tracking'] = $row["id"];
                                    $_SESSION['first_name'] = $row["first_name"];
                                    $_SESSION['last_name'] = $row["last_name"];
                                    $_SESSION['ct_ex_name'] = $row["ct_ex_name"];
                                    $_SESSION['title'] = $row["title"];
                                    $_SESSION['id_article'] = $row["id_article"];
                                    $_SESSION['introduction'] = $row["introduction"];
                                    $_SESSION['methology'] = $row["methology"];
                                    $_SESSION['result_discussion'] = $row["result_discussion"];
                                    $_SESSION['conclusion_abstract'] = $row["conclusion_abstract"];
                                    $_SESSION['submited'] = $row["submited"];
                                    $_SESSION['under_review'] = $row["under_review"];
                                    $_SESSION['revision'] = $row["revision"];
                                    $_SESSION['accepted'] = $row["accepted"];
                                    $_SESSION['published'] = $row["published"];
                                    $_SESSION['one_to_one'] = $row["one_to_one"];
                                    $_SESSION['process'] = $row["process"];
                                    $_SESSION['id_tracking_status'] = $row["id_tracking_status"];
                                    $lastupdate = $row["date"];
                                }
                                ?>
                                <div class="form-group">
                                    <span><b>สถานะ (Status) : &nbsp</b></span><br>
                                    <?php
                                    if ($_SESSION['id_tracking_status'] == '1') {

                                        echo "<i class = 'btn btn-danger btn-user btn-block '> On Process</i> ";
                                        echo "<input type='hidden' value='1' name = 'id_tracking_status' >";
                                    } else if ($_SESSION['id_tracking_status'] == '2') {

                                        echo "<i class = 'btn btn-success btn-user btn-block'> Success</i> ";
                                        echo "<input type='hidden' value='2' name = 'id_tracking_status' >";
                                    }
                                    ?>
                                </div>
                                <form class="insert-form" action="tracking_table_user.php" method="post">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <span><b>ลำดับ (No.) : &nbsp</b></span>
                                            <input style="width: 100%;" type="text" class="form-control-plaintext" value="<?php echo $_SESSION['id_tracking']; ?>" name="id" readonly required>
                                        </div>
                                        <input style="width: 100%;" type="hidden" value="<?php echo $_SESSION['id_article']; ?>" name="id_article" readonly required>
                                        <div class="form-group">
                                            <span><b>ศูนย์ความเป็นเลิศ (Center of Excellence) : &nbsp</b></span>
                                            <input style="width: 100%;" type="text" class="form-control-plaintext" value="<?php echo $_SESSION['ct_ex_name']; ?>" name="ct_ex_name" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <span><b>ชื่อ (First Name) : &nbsp</b></span>
                                            <input style="width: 100%;" type="text" class="form-control-plaintext" value="<?php echo  $_SESSION['first_name']; ?>" name="first_name" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <span><b>นามสกุล (Last Name): &nbsp</b></span>
                                            <input style="width: 100%;" type="text" class="form-control-plaintext" value="<?php echo  $_SESSION['last_name']; ?>" name="last_name" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span><b>ชื่อบทความ (Article Title) : &nbsp</b></span>
                                        <textarea style="width: 100%;" type="text" class="form-control-plaintext" name="title" readonly required><?php echo $_SESSION['title']; ?></textarea>
                                    </div>
                                    <hr>
                                    <div class="text-center"><br>
                                        <h1 class="h4 text-gray-900 mb-4">เลือกขั้นตอนที่คุณกำลังทำตอนนี้ (Choose the
                                            steps you are taking now)</h1>
                                    </div>
                                    <div class="form-group">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Introduction</th>
                                                            <th>Methology</th>
                                                            <th>Result & Discussion</th>
                                                            <th>Conclusion & Abstract </th>
                                                            <th>submited</th>
                                                            <th>under_review</th>
                                                            <th>revision</th>
                                                            <th>accepted</th>
                                                            <th>published</th>
                                                            <th>1:01</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <?php if ($_SESSION['introduction'] == 'Success') {
                                                                    echo "<img src='img/success.png' class='imginput'>";
                                                                } else {
                                                                    echo "<input  type='radio' style='width:100px' name = 'introduction' value='Success'>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($_SESSION['methology'] == 'Success') {
                                                                    echo "<img src='img/success.png' class='imginput'>";
                                                                } else {
                                                                    echo "<input  type='radio' style='width:100px' name = 'methology' value='Success'>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($_SESSION['result_discussion'] == 'Success') {
                                                                    echo "<img src='img/success.png' class='imginput'>";
                                                                } else {
                                                                    echo "<input  type='radio' style='width:100px' name = 'result_discussion' value='Success'>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($_SESSION['conclusion_abstract'] == 'Success') {
                                                                    echo "<img src='img/success.png' class='imginput'>";
                                                                } else {
                                                                    echo "<input  type='radio' style='width:100px' name = 'conclusion_abstract' value='Success'>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($_SESSION['submited'] == 'Success') {
                                                                    echo "<img src='img/success.png' class='imginput'>";
                                                                } else {
                                                                    echo "<input  type='radio' style='width:100px' name = 'submited' value='Success'>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($_SESSION['under_review'] == 'Success') {
                                                                    echo "<img src='img/success.png' class='imginput'>";
                                                                } else {
                                                                    echo "<input  type='radio' style='width:100px' name = 'under_review' value='Success'>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($_SESSION['revision'] == 'Success') {
                                                                    echo "<img src='img/success.png' class='imginput'>";
                                                                } else {
                                                                    echo "<input  type='radio' style='width:100px' name = 'revision' value='Success'>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($_SESSION['accepted'] == 'Success') {
                                                                    echo "<img src='img/success.png' class='imginput'>";
                                                                } else {
                                                                    echo "<input  type='radio' style='width:100px' name = 'accepted' value='Success'>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($_SESSION['published'] == 'Success') {
                                                                    echo "<img src='img/success.png' class='imginput'>";
                                                                } else {
                                                                    echo "<input  type='radio' style='width:100px' name = 'published' value='Success'>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($_SESSION['one_to_one'] == 'Success') {
                                                                    echo "<img src='img/success.png' class='imginput'>";
                                                                } else {
                                                                    echo "<input  type='radio' style='width:100px' name = 'one_to_one' value='Success'>";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php
                                        if ($_SESSION['id_tracking_status'] == '1') {
                                        ?>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <span>แก้ไข ณ เวลา (Current Time) : &nbsp</span>
                                                    <input type="text" class="form-control-plaintext" placeholder="Date" name="date" value="<?php echo date('H:i:s d,M Y', strtotime("+6 hour")); ?>" readonly required>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-row">
                                                <span style="color:red">*โปรดตรวจสอบข้อมูลก่อนทุกครั้งก่อน Submit (Please
                                                    check all information first to Submit)</span>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <input type="checkbox" required>
                                                <span style="color:red">**หากตรวจสอบข้อมูลครบถ้วนแล้วโปรดคลิกเพื่อยืนยัน
                                                    (Please check this box If you want to proceed)</span>
                                            </div>
                                            <hr>
                                            <!-- <input name="form_tracking_update" class="btn btn-primary btn-user btn-block" type="submit"></input> -->

                                            <button type="button" class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#exampleModalCenter">
                                                Submit
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
                                                            
                                                            <?php
                                                            echo 'Do you want to continue Tracking?<hr>Title : '.$_SESSION['title'];
                                                            ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success" name="form_tracking_update">Confirm</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        <?php
                                        } else if ($_SESSION['id_tracking_status'] == '2') {
                                        ?>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <span>แก้ไขล่าสุด (Last Update) : &nbsp </span>
                                                    <?php
                                                    $lastdatetime = strtotime($lastupdate);
                                                    $datetimeupdate = date("H:i:s d,M Y", $lastdatetime);
                                                    ?>
                                                    <input type="text" class="form-control form-control-user" value="<?php echo $datetimeupdate; ?>" readonly>
                                                </div>
                                            </div>
                                            <button href="tracking_table_user.php" class="btn btn-primary btn-user btn-block" type="submit">
                                                << Back</button> <?php
                                                                }
                                                                    ?></form> <?php
                                                include('includes/footer.php');
                                                include('includes/script.php');
                                                ?>