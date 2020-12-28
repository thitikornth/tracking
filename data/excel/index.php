<?php
$conn = mysqli_connect("localhost", "root", "", "research_form");

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT into article (id,school_name,title,author,journal,vol,quartile_id,cite_score,percentle,pfs_m,pfs_wu,ref,date,id_users,id_tracking_status)
                   values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "',
                   '" . $column[6] . "','" . $column[7] . "','" . $column[8] . "','" . $column[9] . "','" . $column[10] . "',
                   '" . $column[11] . "','" . $column[12] . "','" . $column[13] . "','" . $column[14] . "')";
            $result = mysqli_query($conn, $sqlInsert);
            
            if (! empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
<script src="jquery-3.2.1.min.js"></script>

<style>
body {
	font-family: Arial;
	width: 550px;
}

.outer-scontainer {
	background: #F0F0F0;
	border: #e0dfdf 1px solid;
	padding: 20px;
	border-radius: 2px;
}

.input-row {
	margin-top: 0px;
	margin-bottom: 20px;
}

.btn-submit {
	background: #333;
	border: #1d1d1d 1px solid;
	color: #f0f0f0;
	font-size: 0.9em;
	width: 100px;
	border-radius: 2px;
	cursor: pointer;
}

.outer-scontainer table {
	border-collapse: collapse;
	width: 100%;
}

.outer-scontainer th {
	border: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.outer-scontainer td {
	border: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</head>

<body>
    <h2>Import CSV file into Mysql using PHP</h2>
    
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>
               <?php
            $sqlSelect = "SELECT * FROM article";
            $result = mysqli_query($conn, $sqlSelect);
            
            if (mysqli_num_rows($result) > 0) {
                ?>
            <table id='userTable'>
            <thead>
                <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>title</th>
                    <th>author</th>
                    <th>journal</th>
                    <th>vol</th>
                    <th>quartile_id</th>
                    <th>cite_score</th>
                    <th>percentle</th>
                    <th>pfs_m</th>
                    <th>pfs_wu</th>
                    <th>ref</th>
                    <th>date</th>
                    <th>Users</th>
                    <th>Status</th>

                </tr>
            </thead>
<?php
                
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    
                <tbody>
                <tr>
                    <td><?php  echo $row['id']; ?></td>
                    <td><?php  echo $row['school_name']; ?></td>
                    <td><?php  echo $row['title']; ?></td>
                    <td><?php  echo $row['author']; ?></td>
                    <td><?php  echo $row['journal']; ?></td>
                    <td><?php  echo $row['vol']; ?></td>
                    <td><?php  echo $row['quartile_id']; ?></td>
                    <td><?php  echo $row['cite_score']; ?></td>
                    <td><?php  echo $row['percentle']; ?></td>
                    <td><?php  echo $row['pfs_m']; ?></td>
                    <td><?php  echo $row['pfs_wu']; ?></td>
                    <td><?php  echo $row['ref']; ?></td>
                    <td><?php  echo $row['date']; ?></td>
                    <td><?php  echo $row['id_users']; ?></td>
                    <td><?php  echo $row['id_tracking_status']; ?></td>
                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php } ?>
    </div>

</body>

</html>