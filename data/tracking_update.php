<?php
include('includes/connection.php');

if (isset($_POST['form_tracking_update'])) {
  $_SESSION['id'] = $_POST['id'];
  $date = date('Y-m-d H:i:s', strtotime("+5 hour", strtotime($_POST["date"])));
?>
  <script src="sweetalert/jquery-3.5.1.min.js"></script>
  <script src="sweetalert/sweetalert2.all.min.js"></script>
  <?php
  if ($_POST['introduction'] != null) {
    $_SESSION['introduction'] = $_POST['introduction'];
    $sql = "UPDATE `tracking` SET `introduction` = '" . $_SESSION['introduction'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());
  } else if ($_POST['methology'] != null) {
    $_SESSION['methology'] = $_POST['methology'];
    $sql = "UPDATE `tracking` SET `methology` = '" . $_SESSION['methology'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());
  } else if ($_POST['result_discussion'] != null) {
    $_SESSION['result_discussion'] = $_POST['result_discussion'];
    $sql = "UPDATE `tracking` SET `result_discussion` = '" . $_SESSION['result_discussion'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());
  } else if ($_POST['conclusion_abstract'] != null) {
    $_SESSION['conclusion_abstract'] = $_POST['conclusion_abstract'];
    $sql = "UPDATE `tracking` SET `conclusion_abstract` = '" . $_SESSION['conclusion_abstract'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());
  } else if ($_POST['submited'] != null) {
    $_SESSION['submited'] = $_POST['submited'];
    $sql = "UPDATE `tracking` SET `submited` = '" . $_SESSION['submited'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());
  } else if ($_POST['under_review'] != null) {
    $_SESSION['under_review'] = $_POST['under_review'];
    $sql = "UPDATE `tracking` SET `under_review` = '" . $_SESSION['under_review'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());
  } else if ($_POST['revision'] != null) {
    $_SESSION['revision'] = $_POST['revision'];
    $sql = "UPDATE `tracking` SET `revision` = '" . $_SESSION['revision'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());
  } else if ($_POST['accepted'] != null) {
    $_SESSION['accepted'] = $_POST['accepted'];
    $sql = "UPDATE `tracking` SET `accepted` = '" . $_SESSION['accepted'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());
  } else if ($_POST['published'] != null) {
    $_SESSION['published'] = $_POST['published'];
    $sql = "UPDATE `tracking` SET `published` = '" . $_SESSION['published'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());
  } else if ($_POST['one_to_one'] != null) {
    $_SESSION['one_to_one'] = $_POST['one_to_one'];
    $_SESSION['id_tracking_status'] = '2';
    $sql = "UPDATE `tracking` SET `one_to_one` = '" . $_SESSION['one_to_one'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());

    $sql = "UPDATE `tracking` SET `id_tracking_status` = '" . $_SESSION['id_tracking_status'] . "' WHERE `tracking`.`id` = '" . $_SESSION['id'] . "'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());
  }

  echo '<script type="text/javascript">
        swal.fire("Tracking Research Article System ", "SUCCESS", "success");
        </script>';

  ?>
  <meta http-equiv=refresh content=1.0;URL='tracking_table.php'>
<?php
}
?>