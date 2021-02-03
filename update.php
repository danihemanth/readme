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




// echo "value1 = $value1;";
// echo "value2 = $value2;";
// echo "value3 = $value3;";
// echo "reading_time = $reading_time;";

$_SESSION['val1']=$value1;
$_SESSION['val2']=$value2;
$_SESSION['val3']=$value3;
$_SESSION['readdt']=$reading_time;

$data[]=array();
foreach($result as $row){
    $data[]=$row;
}




 //$data[]=array($value1,$value2,$value3,$reading_time);
 
print json_encode($data);


$result->free();
$conn->close();
?>

