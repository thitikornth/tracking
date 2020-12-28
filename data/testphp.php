<?php
include('includes/connection.php');
?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>
<?php
echo $q = $_GET['q'];


$stmt = $pdo->query("SELECT `school`.*, COUNT(`school_name`), `article`.`date` FROM `school` 
LEFT JOIN `article` ON `article`.`school_name` = `school`.`id` WHERE `article`.`date` = '" . $q . "' GROUP BY `school`.`id`");

    


echo "<table>
<tr>
<th>School</th>
<th>Result</th>

</tr>";
while ($row = $stmt->fetch()) {
  echo "<tr>";
  echo "<td>" . $row['school_initial'] . "</td>";
  echo "<td>" . $row['COUNT(`school_name`)'] . "</td>";

  echo "</tr>";
}
echo "</table>";
?>
</body>
</html>