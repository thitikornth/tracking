<style>
  .scale {
    height: 100%;
    width: 100%;
    text-align: center;
  }
</style>
<script src="../vendor/chart.js/Chart.min.js"></script>
<div class="scale">
  <canvas id="piechart"></canvas>

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

  <script type="text/javascript">
  
function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
    // Pie Chart Example
    var ctx = document.getElementById("piechart");
    var piechart = new Chart(ctx, {
      type: 'doughnut',

      data: {
        labels: [<?php echo $datesave; ?>],
        datasets: [{
          data: [<?php echo $ptotal; ?>],
          backgroundColor: ['#3B33FF', '#33E5FF', '#33FFBB', '#33FF7F', '#46FF33', '#8EFF33', '#E1FF33', '#FFDD33', '#FFA133', '#FF7B33', '#FF6433', '#9D33FF', '#CA33FF', '#F433FF', '#FF33D5', '#FF33B0', '#FF3377', '#9D33FF'],
          hoverBackgroundColor: ['#3B33FF', '#33E5FF', '#33FFBB', '#33FF7F', '#46FF33', '#8EFF33', '#E1FF33', '#FFDD33', '#FFA133', '#FF7B33', '#FF6433', '#9D33FF', '#CA33FF', '#F433FF', '#FF33D5', '#FF33B0', '#FF3377', '#9D33FF'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: true,
          caretPadding: 10,
        },
        yAxes: [{
          ticks: {
            min: 0,
            max: 15000,
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              return '$' + number_format(value);
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
        legend: {
          display: true,
          reverse: false,
          position: 'bottom'
        },
        cutoutPercentage: 50,

      },
    });
  </script>