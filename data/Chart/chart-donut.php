<style>
  body {
    margin: 0;

  }

  .container {
    height: 100vh;
    margin: 0 auto;
  }

  .chart-wrapper {
    width: 90%;
    height: 90%;
    margin: 0 auto;

  }
</style>
<!DOCTYPE html>
<html lang="th">


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="./css/style.css"> -->

<body>



  <div class="chart-wrapper">
    <canvas id="myChart"></canvas>
  </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</body>

</html>
<?php
include('../includes/connection.php');
$datesave = array();
$ptotal = array();

$stmt = $pdo->query("SELECT `school`.*, COUNT(`school_name`)  FROM `school` 
LEFT JOIN `article` ON `article`.`school_name` = `school`.`id` GROUP BY `school`.`id` ");

while ($rs = $stmt->fetch()) {
  $datesave[] = "\"" . $rs["school_initial"] . "\"";
  $ptotal[] = "\"" . $rs["COUNT(`school_name`)"] . "\"";
}
$datesave = implode(",", $datesave);
$ptotal = implode(",", $ptotal);

?>
<script>
  let ctx = document.getElementById('myChart').getContext('2d');

  let myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      datasets: [{
        data: [<?php echo $ptotal; ?>],
        backgroundColor: ['#3B33FF', '#33E5FF', '#33FFBB', '#33FF7F', '#46FF33', '#8EFF33', '#E1FF33', '#FFDD33', '#FFA133', '#FF7B33', '#FF6433', '#9D33FF', '#CA33FF', '#F433FF', '#FF33D5', '#FF33B0', '#FF3377', '#9D33FF'],
        hoverBackgroundColor: ['#3B33FF', '#33E5FF', '#33FFBB', '#33FF7F', '#46FF33', '#8EFF33', '#E1FF33', '#FFDD33', '#FFA133', '#FF7B33', '#FF6433', '#9D33FF', '#CA33FF', '#F433FF', '#FF33D5', '#FF33B0', '#FF3377', '#9D33FF'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
      labels: [<?php echo $datesave; ?>],
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        position: 'bottom',
        display: false

      },
      plugins: {
        datalabels: {
          color: '#fff',
          anchor: 'end',
          align: 'start',
          offset: -5,
          borderWidth: 2,
          borderColor: '#fff',
          borderRadius: 25,
          backgroundColor: (context) => {
            return context.dataset.backgroundColor;
          },
          font: {
            weight: 'bold',
            size: '10'
          },
          formatter: (value) => {
            return value + " pcs.";
          }
        }
      },
      cutoutPercentage: 50,

    }

  })
</script>