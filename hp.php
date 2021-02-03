<?php
session_start();

$servername = "localhost";

// REPLACE with your Database name
$dbname = "esp_board";
// REPLACE with Database user
$username = "root";
// REPLACE with Database user password
$password = "YES";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$rr=$_SESSION['name'];
$sql = "SELECT id, value1, value2, value3, reading_time FROM sensordata WHERE username = '$rr' order by reading_time desc limit 40";

$result = $conn->query($sql);
$sensor_data[]=array();
while ($data =$result->fetch_assoc()){
    $sensor_data[] = $data;
}

$readings_time = array_column($sensor_data, 'reading_time');

// ******* Uncomment to convert readings time array to your timezone ********
$i = 0;
foreach ($readings_time as $reading){
    // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
    $readings_time[$i] = date("Y-m-d H:i:s", strtotime("$reading - 1 hours"));
    // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
    //$readings_time[$i] = date("Y-m-d H:i:s", strtotime("$reading + 4 hours"));
    $i += 1;
}

$value1 = json_encode(array_reverse(array_column($sensor_data, 'value1')), JSON_NUMERIC_CHECK);
$value2 = json_encode(array_reverse(array_column($sensor_data, 'value2')), JSON_NUMERIC_CHECK);
$value3 = json_encode(array_reverse(array_column($sensor_data, 'value3')), JSON_NUMERIC_CHECK);
$reading_time = json_encode(array_reverse($readings_time), JSON_NUMERIC_CHECK);


// echo $value1;
// echo $value2;
// echo $value3;
// echo $reading_time;

$_SESSION['val1']=$value1;
$_SESSION['val2']=$value2;
$_SESSION['val3']=$value3;
$_SESSION['readdt']=$reading_time;

// $data[]=array();
// foreach($result as $row){
//     $data[]=$row;
// }


 //$data[]=array($value1,$value2,$value3,$reading_time);

print json_encode($data);

header('Location: home.php');

$result->free();
$conn->close();
?>


<script>



var value1 = <?php echo $_SESSION['val1'];?>;
var value2 = <?php echo $_SESSION['val2']; ?>;
var value3 = <?php echo $_SESSION['val3']; ?>;
var reading_time = <?php echo $_SESSION['readdt']; ?>;

var customersOptions = {
    series: [{
      name: 'BPM',
      data: value1
    }, {
      name: 'BPH',
      data: value2
    }, {
      name: 'AVG BPM',
      data: value3
    }],
    chart: {
      height: 295,
      type: 'area',
      toolbar: {
        show: false
      }
    },
    colors: [themeColors.accent, themeColors.info, themeColors.orange],
    title: {
      text: 'Tracking',
      align: 'left'
    },
    legend: {
      position: 'top'
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      width: [2, 2, 2],
      curve: 'smooth'
    },
    xaxis: {
      type: 'datetime',
      categories: reading_time
    },
    tooltip: {
      x: {
        format: 'dd/MM/yy HH:mm'
      }
    }
  };

  var customersChart = new ApexCharts(document.querySelector("#customers-chart"), customersOptions);
  customersChart.render();


//   var myVar = setInterval(myTimer, 4500);

// function myTimer() {
 
//     $("#customers-chart").load(location.href + " #customers-chart");
   
// }
// setInterval(() => {
//     var customersChart = new ApexCharts(document.querySelector("#customers-chart"), customersOptions);
//   customersChart.render();    
// }, 5000);

 //gauge chart

  var teamGaugeOptions = {
  
    series: [98],
    title: {
      text: 'Real time BPM'
    },
    chart: {
      height: 345,
      type: 'radialBar',
      sparkline: {
        enabled: true
      },
      toolbar: {
        show: false
      }
    },
    colors: [themeColors.accent, themeColors.secondary, themeColors.orange, themeColors.purple, themeColors.info],
    plotOptions: {
      radialBar: {
        startAngle: -90,
        endAngle: 90,
        track: {
          background: "#e7e7e7",
          strokeWidth: '97%',
          margin: 5,
          // margin is in pixels
          dropShadow: {
            enabled: false,
            top: 2,
            left: 0,
            color: '#999',
            opacity: 1,
            blur: 2
          }
        },
        dataLabels: {
          name: {
            show: false
          },
          value: {
            offsetY: -2,
            fontSize: '22px'
          }
        }
      }
    },
    grid: {
      padding: {
        top: 80
      }
    },
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'light',
        shadeIntensity: 0.1,
        inverseColors: false,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 50, 53, 91]
      }
    },
    labels: ['Average Results']
  };



  var teamGauge = new ApexCharts(document.querySelector("#team-gauge"), teamGaugeOptions);
  teamGauge.render(); //Profit Chart


  var value1 = value1;
  var profitChartOptions = {
    series: [{
      name: 'Ratio',
      data: value1,
    }],
    chart: {
      height: 262,
      type: 'bar',
      toolbar: {
        show: false
      }
    },
    plotOptions: {
      bar: {
        dataLabels: {
          position: 'top' // top, center, bottom

        }
      }
    },
    dataLabels: {
      enabled: true,
      formatter: function formatter(val) {
        return val + "%";
      },
      offsetY: -20,
      style: {
        fontSize: '12px',
        colors: ["#304758"]
      }
    },
    xaxis: {
      categories: ["May", "Jun", "Jul", "Aug", "Sep"],
      position: 'top',
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      },
      crosshairs: {
        fill: {
          type: 'gradient',
          gradient: {
            colorFrom: '#D8E3F0',
            colorTo: '#BED1E6',
            stops: [0, 100],
            opacityFrom: 0.4,
            opacityTo: 0.5
          }
        }
      },
      tooltip: {
        enabled: true
      }
    },
    yaxis: {
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      },
      labels: {
        show: false,
        formatter: function formatter(val) {
          return val + "%";
        }
      }
    },
    colors: [themeColors.green, themeColors.secondary, themeColors.orange],
    title: {
      text: 'Sync Percentage',
      align: 'left'
    }
  };
  var profitChart = new ApexCharts(document.querySelector("#profit-chart"), profitChartOptions);
  profitChart.render();
 
</script>

