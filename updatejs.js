


"use strict";



// setInterval(function()
// {
//     $.ajax({
//         type: "get",
//         url: "update.php",
        
//         success:function(data)

//         {  

//             var values1 =[];
//             var values2 =[];
//             var values3 =[];
//             var reading_times =[];
//             var dati=[];
//             for(var i=0;i<data.length;i++){
              
//                 values1.push(data[i].value1);
//                 values2.push(data[i].value2);
//                 values3.push(data[i].value3);
//                 reading_times.push(data[i].reading_time);
              
//             }
//            // $("#customers-chart").load("hp.php");
//           // refresh();
//             //console.log the response
             

   
//             console.log(value2);
            
           
//         }
//     });
// }, 3000);

 //10000 milliseconds = 10 seconds

// $(document).ready(function () {


//   $.ajax({
//   url:"http://localhost/htdocs/homepush.php",
//   method:"GET",
//   success:function($data){
//     console.log($data);
//   },
//   error:function(data){
//     console.log(data);
//   },

//    });

  //customers chart
//   $(document).ready(function()){
//     setInterval(() => {
     
//     }, 2000);
//}

// setInterval(function()
// {
// function loadDoc() {
//   var xhttp = new XMLHttpRequest();
//   xhttp.onreadystatechange = function() {
//     if (this.readyState == 4 && this.status == 200) {
      
//       console.log(responseText);
//     }
//   };
//   xhttp.open("GET", "hp.php", true);
//   xhttp.send();
// }
// }, 1000);










// var value1 = <?php echo $_SESSION['val1'];?>;
// var value2 = <?php echo $_SESSION['val2']; ?>;
// var value3 = <?php echo $_SESSION['val3']; ?>;
// var reading_time = <?php echo $_SESSION['readdt']; ?>;


setInterval(function()
{
    $.ajax({
  url:"update.php",
  method:"GET",
  success:function(data){
    console.log(data);
                var len=data.length;
                var values1 =[];
                var values2 =[];
                var values3 =[];
                var reading_times =[];
               
                for(var i=0;i<len;i++){
                  
                    values1.push(data[i].value1);
                    
                    values2.push(data[i].value2);
                    values3.push(data[i].value3);
                    reading_times.push(data[i].reading_time);
                }

                var customersOptions = {
                    series: [{
                      name: 'BPM',
                      data: values1
                    }, {
                      name: 'BPH',
                      data: values2
                    }, {
                      name: 'AVG BPM',
                      data: values3
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
                      categories: reading_times
                    },
                    tooltip: {
                      x: {
                        format: 'dd/MM/yy HH:mm'
                      }
                    }
                  };

                  var customersChart = new ApexCharts(document.querySelector("#customers-chart"), customersOptions);
                  customersChart.render();

  },
  error:function(data){
    console.log(data);
  },

   });

}, 3000);


 




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


//   var value1 = <?php echo $_SESSION['val1'];?>;
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








