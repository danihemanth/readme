
<?php

/*
  Alsan Parajuli
  Complete project details at https://theiotprojects.com/
  
  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files.
  
  The above copyright notice and this permission notice shall be included in all
  copies or substantial portions of the Software.
*/

$servername = "localhost";

// REPLACE with your Database name
$dbname = "sensor database";
// REPLACE with Database user
$username = "root";
// REPLACE with Database user password
$password = "YES";

// Keep this API Key value to be compatible with the ESP8266 code provided in the project page. 
// If you change this value, the ESP8266 sketch needs to match
$api_key_value = "theiotprojects";

$api_key= $sensor = $location = $value1 = $value2 = $distance = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $sensor = test_input($_POST["sensor"]);
        $location = test_input($_POST["location"]);
        $distance = test_input($_POST["distance"]);
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO sensordata (sensor, location, distance)
        VALUES ('" . $sensor . "', '" . $location . "', '" . $distance . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}