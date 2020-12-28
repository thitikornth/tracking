<?php
include('includes/connection.php');
include('includes/script.php');


if (isset($_POST['form_submit'])) {
  $_SESSION['form_submit'] = $_POST['form_submit'];
  echo $_SESSION['school_name'] = $_POST['school_name'];
  $_SESSION['title'] = $_POST['title'];
  $_SESSION['author'] = $_POST['author'];
  $_SESSION['journal'] = $_POST['journal'];
  $_SESSION['vol'] = $_POST['vol'];
  $_SESSION['quartile_id'] = $_POST['quartile_id'];
  $_SESSION['cite_score'] = $_POST['cite_score'];
  $_SESSION['percentle'] = $_POST['percentle'];
  $_SESSION['pfs_m'] = $_POST['pfs_m'];
  $_SESSION['pfs_wu'] = $_POST['pfs_wu'];
  $_SESSION['ref'] = $_POST['ref'];
  $_SESSION['id_users'] = $_POST['id_users'];
  $_SESSION['id_tracking_status'] = $_POST['id_tracking_status'];
  $stmt = $pdo->query("SELECT * FROM `users` ");
  while ($row = $stmt->fetch()) {
    $_SESSION['id_ct_ex'] = $row["id_ct_ex"];
  }

  echo '<script type="text/javascript">
  swal.fire("", "ลบข้อมูลเรียบร้อย !!", "success");
  </script>';

  $date = date('Y-m-d H:i:s', strtotime("+5 hour", strtotime($_POST["date"])));


?>


  <!-- <script>
    const href = "pub_form.php";
    const href_back = "pub_form.php";
    $(document).ready(function() {
      Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Save`,
        denyButtonText: `Don't save`,
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = href;
          Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
          )
        } else if (result.isDenied) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
          })
          if (result.isDenied) {
            window.location.href = href;
          }
        }
      })
    })
  </script> -->

<?php
}

?>


<!-- <meta http-equiv=refresh content=0.5;URL='pub_form.php'> -->


<?php


?>