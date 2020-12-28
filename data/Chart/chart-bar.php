
<?php
include('../includes/connection.php');
if (isset($_POST["formdate"])) {
  $stmt = $pdo->query("SELECT `school`.*, COUNT(`school_name`), `article`.`date` FROM `school` 
  LEFT JOIN `article` ON `article`.`school_name` = `school`.`id` WHERE `article`.`date` BETWEEN '" . $_POST['formdate'] . "' AND '" . $_POST["todate"] . "' GROUP BY `school`.`id`");
} else {
  $stmt = $pdo->query("SELECT `school`.*, COUNT(`school_name`), `article`.`date` FROM `school` 
    LEFT JOIN `article` ON `article`.`school_name` = `school`.`id` GROUP BY `school`.`id`");
}
$school_initial = array();
$sum_school = array();
while ($row = $stmt->fetch()) {

  $school_initial[] = "\"" . $row["school_initial"] . "\"";
  $sum_school[] = "\"" . $row["COUNT(`school_name`)"] . "\"";
}
$school_initial = implode(",", $school_initial);
$sum_school = implode(",", $sum_school);

?>

<script type="text/javascript">
  $(document).ready(function() {
    var date = "<?= $date ?>";
    $("#date").val(date);


    $("#date").change(function() {
      var date = $("#date").val();
      if (isset(date != null)) {

        $("#date").val("").focus();
      }

    });

  });
</script>

<style>
  .scale {
    height: 100%;
    width: 100%;
    text-align: center;
  }

  .bars {
    content: attr(data-percentage) ' pcs.';
    position: relative;
    bottom: 37px;

  }
</style>
<script src="vendor/chart.js/Chart.min.js"></script>
<div class="scale">
  <canvas id="barchart"></canvas>

  <p align="center">
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

      // Bar Chart Example
      var ctx = document.getElementById("barchart");
      var barchart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [<?php echo $school_initial; ?>],
          datasets: [{
            label: "Statistics of all research articles",
            backgroundColor: "#a22fbe",
            hoverBackgroundColor: "#56006b",
            borderColor: "#a22fbe",
            data: [<?php echo $sum_school; ?>],
          }],
        },
        options: {
          maintainAspectRatio: false,
          responsive: true,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {
            xAxes: [{
              time: {
                unit: 'month'
              },
              gridLines: {
                display: false,
                drawBorder: false
              },
              ticks: {
                maxTicksLimit: 20
              },
              maxBarThickness: 25,
            }],
            yAxes: [{
              ticks: {
                min: 0,
                // max: 5,
                stepSize: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                  return number_format(value);
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
          },
          legend: {
            display: false
          },
          tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
              label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ' : ' + number_format(tooltipItem.yLabel) + ' Article ';
              }
            }
          },
        }
      });
    </script>
</div>