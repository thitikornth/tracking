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
                                    <h1 class="h4 text-gray-900 mb-4">Fill out research articles<b></h1>
                                </div>

                                <form class="insert-form" action="tracking_table_user.php" method="post">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <a class="red-star">*</a><span>School of: &nbsp</span>
                                            <select class='form-control' name='school_name' required>
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
                                            <a class="red-star">*</a><span>Center of Excellence : &nbsp</span>
                                            <select class='form-control' name='id_ct_ex' required>
                                                <option></option>
                                                <?php
                                                $stmt = $pdo->query("SELECT * FROM `ct_ex` ");
                                                while ($row = $stmt->fetch()) {
                                                    echo "<option value='" . $row["id"] . "'>" . $row["ct_ex_name_eng"] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <a class="red-star">*</a><span>Title : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="title" required>
                                        </div>
                                        <div class="form-group">
                                            <a class="red-star">*</a><span>Author : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="author" required>
                                        </div>
                                        <div class="form-group">
                                            <span>Journal : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="journal">
                                        </div>
                                        <div class="form-group">
                                            <span>Volume : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="vol">
                                        </div>
                                        <div class="form-group">
                                            <a class="red-star">*</a><span>Quartile : &nbsp</span>
                                            <select style="width: 100%;" class="form-control " name='quartile_id' required>
                                                <option></option>
                                                <option value="1"> Q1</option>
                                                <option value="2"> Q2 </option>
                                                <option value="3"> Q3 </option>
                                                <option value="4"> Q4 </option>
                                                <option value="5"> Q5 </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <span>Cite score : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="cite_score">
                                        </div>
                                        <div class="form-group">
                                            <span>Progress % (Only fill in numbers) : &nbsp</span>
                                            <input style="width: 100%;" type="text" class="form-control form-control-user" name="percentle">
                                        </div>
                                        <div class="form-group">
                                            <a class="red-star">*</a><span>Status types : &nbsp</span>
                                            <select style="width: 100%;" class="form-control " name='article_types' required>
                                                <option></option>
                                                <option value="Alpha"> Alpha</option>
                                                <option value="Delta"> Delta</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <span>Professor : &nbsp</span>
                                            <input style="width: 100%;" type="radio" class="form-control form-control-user" name="pfs_m" value="internal">
                                        </div>
                                        <div class="form-group">
                                            <span>Professor in WU : &nbsp</span>
                                            <input style="width: 100%;" type="radio" class="form-control form-control-user" name="pfs_wu" value="external">
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" class="form-control form-control-user" placeholder="Date" name="date" value="<?php echo date('Y/m/d H:i:s', strtotime('+6 hour')); ?>" required>
                                            <?php
                                            if (isset($_SESSION["admin_id"])) {
                                            ?>
                                                <input type="hidden" class="form-control form-control-user" name="id_users" value="<?php echo $_SESSION['admin_id'] ?>" required>
                                            <?php
                                            } else if (isset($_SESSION["users_id"])) {
                                            ?>
                                                <input type="hidden" class="form-control form-control-user" name="id_users" value="<?php echo $_SESSION['users_id'] ?>" required>
                                            <?php
                                            }
                                            ?>
                                            <input type="hidden" class="form-control form-control-user" name="id_tracking_status" value="1" required>
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
                                    <!-- <input name="form_submit" class="btn btn-primary btn-user btn-block" type="submit"></input> -->

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
                                                    echo 'Do you want to fill out research articles ?';
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