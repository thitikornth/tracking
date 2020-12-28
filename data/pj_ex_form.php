<?php
session_start();
include('includes/head.php');
include('includes/navbar_side.php');
include('includes/navbar_top.php');
include('includes/connection.php');
?>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="pub_table.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" target="_blank"><i></i> Article Publish Table </a>
        </div> -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row1">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Fill out Project funded by external<b></h1>
                                </div>

                                <form class="insert-form" action="pj_ex_table.php" method="post">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <a class="red-star">*</a><span>Date : &nbsp</span>
                                            <input style="width: 100%;" type="date" class="form-control form-control-user" name="pj_date" required>
                                        </div>
                                        <div class="form-group">
                                            <a class="red-star">*</a><span>Project topic : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="pj_topic" required>
                                        </div>
                                        <div class="form-group">
                                            <a class="red-star">*</a><span>Project responsible person (First) : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="pj_person_fr" required>
                                        </div>
                                        <div class="form-group">
                                            <span>Project responsible person (Secondary) : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="pj_person_nd">
                                        </div>
                                        <div class="form-group">
                                            <a class="red-star">*</a><span>Budget : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="pj_budget" required>
                                        </div>
                                        <div class="form-group">
                                            <span>Management fee : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="pj_m_fee">
                                        </div>
                                        <div class="form-group">
                                            <a class="red-star">*</a><span>Funding source : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="pj_fund_s" required>
                                        </div>
                                        <div class="form-group">
                                            <span>School : &nbsp</span>
                                            <select class='form-control' name='pj_id_school' required>
                                                <option></option>
                                                <?php
                                                $stmt = $pdo->query("SELECT * FROM `school` ");
                                                while ($row = $stmt->fetch()) {
                                                    echo "<option value='" . $row["id"] . "'>" . $row["school_name_eng"] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <a class="red-star">*</a><span>Processing time (Start) : &nbsp</span>
                                            <input style="width: 100%;" type="date" class="form-control form-control-user" name="pj_pc_start" required>
                                        </div>
                                        <div class="form-group">
                                            <a class="red-star">*</a><span>Processing time (Finish) : &nbsp</span>
                                            <input style="width: 100%;" type="date" class="form-control form-control-user" name="pj_pc_finish" required>
                                        </div>
                                        <div class="form-group">
                                            <a class="red-star">*</a><span>Contract number : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="pj_contract_number" required>
                                        </div>
                                        <div class="form-group">
                                            <span>Project partner : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="pj_partner">
                                        </div>
                                        <div class="form-group">
                                            <span>Target area : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="pj_target">
                                        </div>
                                        <div class="form-group">
                                            <span>Note : &nbsp</span>
                                            <textarea style="width: 100%;" type="text" class="form-control form-control-user" name="pj_note"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control form-control-user" name="pj_date_log" value="<?php echo date('Y/m/d H:i:s', strtotime('+6 hour')); ?>">
                                            <?php
                                            if (isset($_SESSION["admin_id"])) {
                                            ?>
                                                <input type="hidden" class="form-control form-control-user" name="pj_user_log" value="<?php echo $_SESSION['admin_id'] ?>" required>
                                            <?php
                                            } else if (isset($_SESSION["users_id"])) {
                                            ?>
                                                <input type="hidden" class="form-control form-control-user" name="pj_user_log" value="<?php echo $_SESSION['users_id'] ?>" required>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <span style="color:red">*Please check all information first to Submit</span>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <input type="checkbox" required>
                                        <span style="color:red">**Please check this box If you want to proceed</span>
                                    </div>
                                    <hr>

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
                                                    echo 'Do you want to fill out Project funded by external ?';
                                                    ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success" name="form_submit">Confirm</button>
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
    ?>