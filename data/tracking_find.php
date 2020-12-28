<?php 
include('includes/head.php') ;
include('includes/navbar_side.php') ;
include('includes/navbar_top.php') ;
include('includes/connection.php') ;
?>    

<body class="bg-gradient-primary" >
<div class="container">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"></h1>
                        <a href="pub_table.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                ></i> แสดงบทความตีพิมพ์ </a>
                    </div>

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row1">
                    
                        <!-- <div class="col-lg-6"> -->
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">ค้นหาบทความวิจัยที่ต้องการติดาม <br>(Find a Research Article to Tracking)</h1>
                                </div>

                            <form   class="insert-form" action="tracking_pc.php" method = "get">
                            <div class="form-row">
                                <div class="form-group">
                                <span>สำนักวิชา : &nbsp</span>
                                <select  class='form-control' name='school_name' required>
                                    <?php 
                                    $stmt = $pdo->query("SELECT * FROM `school` ");
                                    while ($row = $stmt->fetch()) {
                                        echo "<option value='". $row["id"]."'>".$row["name"]."</option>";
                                    }
                                    ?>
                                    </select>
                                    </div>
                                <div class="form-group">
                                <span>ชื่อบทความ : &nbsp</span>
                                        <input style="width: 100%;" type="text" class="form-control form-control-user"
                                            placeholder="Title" name = "title" required>
                                    </div>
                                    <div class="form-group">
                                    <span>ชื่อผู้แต่ง / ผู้เขียน : &nbsp</span>
                                        <input style="width: 100%;" type="text" class="form-control form-control-user"
                                             placeholder="Author" name ="author" required>
                                    </div>
                                    <div class="form-group">
                                    <span>ชื่อวารสารตีพิมพ์ : &nbsp</span>
                                        <input style="width: 100%;" type="text" class="form-control form-control-user"
                                             placeholder="Journal" name ="journal" required> 
                                    </div>
                                    <div class="form-group">
                                    <span>ฉบับที่ตีพิมพ์ : &nbsp</span>
                                        <input style="width: 100%;" type="text" class="form-control form-control-user"
                                             placeholder="Volume" name = "vol" required>
                                    </div>
                                    <div class="form-group">
                                    <span>Quartile : &nbsp</span>
                                    <select style="width: 100%;" class="form-control " name='quartile_id' required>
                                        <option value="1"> Q1</option>
                                        <option value="2"> Q2 </option>
                                        <option value="3"> Q3 </option>
                                        <option value="4"> Q4 </option>
                                        <option value="5"> Q5 </option>                                       
                                    </select>
                                    </div>
                                    <div class="form-group">
                                    <span>Cite score : &nbsp</span>
                                        <input style="width: 100%;" type="text" class="form-control form-control-user"
                                             placeholder="Cite Scorce" name = "cite_score" required>
                                    </div>
                                    <div class="form-group">
                                    <span>ความคีบหน้า % (กรอกเพียงตัวเลขเท่านั้น) : &nbsp</span>
                                        <input style="width: 100%;" type="text" class="form-control form-control-user"
                                             placeholder="100" name = "percentle" required>
                                    </div>
                                    <div class="form-group">
                                    <span>ผู้เชี่ยวชาญ : &nbsp</span>
                                        <input style="width: 100%;" type="text" class="form-control form-control-user"
                                             placeholder="Professor" name = "pfs_m" required>
                                    </div>
                                    <div class="form-group">
                                    <span>ผู้เชี่ยวชาญในนาม มหาวิทยาลัยวลัยลักษณ์ : &nbsp</span>
                                        <input style="width: 100%;" type="text" class="form-control form-control-user"
                                             placeholder="WU Professor" name = "pfs_wu" >
                                    </div>
                                    <div class="form-group">
                                    <span>แหล่งที่มา : &nbsp</span>
                                        <input style="width: 100%;" type="text" class="form-control form-control-user"
                                             placeholder="www.scopus.com" name = "ref"  required>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control form-control-user"
                                             placeholder="Date" name = "date" value = "<?php echo date("Y/m/d H:i:s") ?>" required>
                                    </div>
                                    <hr>
                                    <!-- <input id='showPopup'   class="btn btn-primary btn-user btn-block" type = "submit" name="submit" >
                                    </input> -->
                                    <button name = "form_submit" class = "btn btn-primary btn-user btn-block" >Submit</button>
                                </form>   
                            </div>
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
    