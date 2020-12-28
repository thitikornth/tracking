<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>

</figure>

<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 100%;
        max-width: 100%;
        margin: 1em auto;
    }

    #container {
        height: 100%;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>


<?php
include('../includes/connection.php');
if (isset($_POST["formdate"])) {

    $stmt = $pdo->query("SELECT `school`.*, COUNT(`school_name`), `article`.`date` FROM `school` 
                                    LEFT JOIN `article` ON `article`.`school_name` = `school`.`id` WHERE `article`.`date` BETWEEN '" . $_POST['formdate'] . "' AND '" . $_POST["todate"] . "' GROUP BY `school`.`id`");
} else {
    $stmt = $pdo->query("SELECT `school`.*, COUNT(`school_name`), `article`.`date` FROM `school` 
                                     LEFT JOIN `article` ON `article`.`school_name` = `school`.`id` GROUP BY `school`.`id`");
}
while ($row = $stmt->fetch()) {
    // echo $row["COUNT(`school_name`)"] . "<br>" . $row["school_initial"];

    $school_initial[] =  $row["school_initial"];
    $sum_school[] = $row["COUNT(`school_name`)"];
}

for ($i = 0; $i < count($school_initial); $i++) {
    echo '"' . $school_initial[$i] . '"' . ",";
}

?>


<script>
    var school_initial = "";
    var sum_school = "";
    var i = 0;
    var school = "<?php echo $school_initial[0]; ?>";
    var arr_school = [<?php for ($i = 0; $i < count($school_initial); $i++) {
                            echo '"' . $school_initial[$i] . '"' . ",";
                        } ?>];
    var arr_sum_school = [<?php for ($i = 0; $i < count($sum_school); $i++) {
                                echo '"' . $sum_school[$i] . '"' . ",";
                            } ?>];
    for (i = 0; i < 19; i++) {
        school_initial += '"' + arr_school[i] + '"' + ',';
        sum_school += arr_sum_school[i];

    }
    // document.write(school_initial);
    document.write(sum_school);
    document.write(arr_sum_school);
    console.log(arr_sum_school);
    console.log(sum_school[0]);


    // Create the chart
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            // text: 'Browser market shares. January, 418'
        },
        subtitle: {
            // text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                // text: 'Total percent market share'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },


        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },

        series: [{
            name: "Browsers",
            colorByPoint: true,
            data: [{

                    name: arr_school[0],
                    y: parseFloat(sum_school[0]),
                    drilldown: arr_school[0]

                }, 
                {
                    name: arr_school[1],
                    y: parseFloat(sum_school[1]),
                    drilldown: arr_school[1]
                },
                {
                    name: arr_school[2],
                    y: parseFloat(sum_school[2]),
                    drilldown: arr_school[2]
                },
                {
                    name: arr_school[3],
                    y: parseFloat(sum_school[3]),
                    drilldown: arr_school[3]
                },
                {
                    name: arr_school[4],
                    y: parseFloat(sum_school[4]),
                    drilldown: arr_school[4]
                },
                {
                    name: arr_school[5],
                    y: parseFloat(sum_school[5]),
                    drilldown: arr_school[5]
                },
                {
                    name: arr_school[6],
                    y: parseFloat(sum_school[6]),
                    drilldown: arr_school[6]
                },
                {
                    name: arr_school[7],
                    y: parseFloat(sum_school[7]),
                    drilldown: arr_school[7]
                },
                {
                    name: arr_school[8],
                    y: parseFloat(sum_school[8]),
                    drilldown: arr_school[8]
                },
                {
                    name: arr_school[9],
                    y: parseFloat(sum_school[9]),
                    drilldown: arr_school[9]
                },
                {
                    name: arr_school[10],
                    y: parseFloat(sum_school[10]),
                    drilldown: arr_school[10]
                },
                {
                    name: arr_school[11],
                    y: parseFloat(sum_school[11]),
                    drilldown: arr_school[11]
                },
                {
                    name: arr_school[12],
                    y: parseFloat(sum_school[12]),
                    drilldown: arr_school[12]
                },
                {
                    name: arr_school[13],
                    y: parseFloat(sum_school[13]),
                    drilldown: arr_school[13]
                },
                {
                    name: arr_school[14],
                    y: parseFloat(sum_school[14]),
                    drilldown: arr_school[14]
                },
                {
                    name: arr_school[15],
                    y: parseFloat(sum_school[15]),
                    drilldown: arr_school[15]
                },
                {
                    name: arr_school[16],
                    y: parseFloat(sum_school[16]),
                    drilldown: arr_school[16]
                },
                {
                    name: arr_school[17],
                    y: parseFloat(sum_school[17]),
                    drilldown: arr_school[17]
                },
                {
                    name: arr_school[18],
                    y: parseFloat(sum_school[18]),
                    drilldown: arr_school[18]
                }
                
            ]
        }],
        drilldown: {
            series: [{
                    name: arr_school[0],
                    id: arr_school[0],
                    data: [
                        [
                            "v65.0",
                            0.1
                        ],
                        [
                            "v64.0",
                            1.3
                        ],
                        [
                            "v63.0",
                            53.02
                        ],
                        [
                            "v62.0",
                            1.4
                        ],
                        [
                            "v61.0",
                            0.88
                        ],
                        [
                            "v60.0",
                            0.56
                        ],
                        [
                            "v59.0",
                            0.45
                        ],
                        [
                            "v58.0",
                            0.49
                        ],
                        [
                            "v57.0",
                            0.32
                        ],
                        [
                            "v56.0",
                            0.29
                        ],
                        [
                            "v55.0",
                            0.79
                        ],
                        [
                            "v54.0",
                            0.18
                        ],
                        [
                            "v51.0",
                            0.13
                        ],
                        [
                            "v49.0",
                            2.16
                        ],
                        [
                            "v48.0",
                            0.13
                        ],
                        [
                            "v47.0",
                            0.11
                        ],
                        [
                            "v43.0",
                            0.17
                        ],
                        [
                            "v29.0",
                            0.26
                        ]
                    ]
                },
                {
                    name: "Firefox",
                    id: "Firefox",
                    data: [
                        [
                            "v58.0",
                            1.02
                        ],
                        [
                            "v57.0",
                            7.36
                        ],
                        [
                            "v56.0",
                            0.35
                        ],
                        [
                            "v55.0",
                            0.11
                        ],
                        [
                            "v54.0",
                            0.1
                        ],
                        [
                            "v52.0",
                            0.95
                        ],
                        [
                            "v51.0",
                            0.15
                        ],
                        [
                            "v50.0",
                            0.1
                        ],
                        [
                            "v48.0",
                            0.31
                        ],
                        [
                            "v47.0",
                            0.12
                        ]
                    ]
                },
                {
                    name: "Internet Explorer",
                    id: "Internet Explorer",
                    data: [
                        [
                            "v11.0",
                            6.2
                        ],
                        [
                            "v10.0",
                            0.29
                        ],
                        [
                            "v9.0",
                            0.27
                        ],
                        [
                            "v8.0",
                            0.47
                        ]
                    ]
                },
                {
                    name: "Safari",
                    id: "Safari",
                    data: [
                        [
                            "v11.0",
                            3.39
                        ],
                        [
                            "v10.1",
                            0.96
                        ],
                        [
                            "v10.0",
                            0.36
                        ],
                        [
                            "v9.1",
                            0.54
                        ],
                        [
                            "v9.0",
                            0.13
                        ],
                        [
                            "v5.1",
                            0.2
                        ]
                    ]
                },
                {
                    name: "Edge",
                    id: "Edge",
                    data: [
                        [
                            "v16",
                            2.6
                        ],
                        [
                            "v15",
                            0.92
                        ],
                        [
                            "v14",
                            0.4
                        ],
                        [
                            "v13",
                            0.1
                        ]
                    ]
                },
                {
                    name: "Opera",
                    id: "Opera",
                    data: [
                        [
                            "v50.0",
                            0.96
                        ],
                        [
                            "v49.0",
                            0.82
                        ],
                        [
                            "v12.1",
                            0.14
                        ]
                    ]
                }
            ]
        }
    });
</script>