<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html>



	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
    <?php

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
$rr=$_SESSION['name'];



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$data=array();
$sql = "SELECT id,username, sensor, location, value1, value2, value3, reading_time FROM Sensordata WHERE username = '$rr'";
$result = $conn->query($sql);
foreach($result as $row){
    $data[]= $row;
   
}

print json_encode($data);


echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <td>ID</td> 
        <td>Username</td> 
        <td>Sensor</td>
        <td>Location</td> 
        <td>Value 1</td> 
        <td>Value 2</td>
        <td>Value 3</td> 
        <td>Timestamp</td> 
      </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];
        $row_usr = $row["username"];
        $row_sensor = $row["sensor"];
        $row_location = $row["location"];
        $row_value1 = $row["value1"];
        $row_value2 = $row["value2"]; 
        $row_value3 = $row["value3"]; 
        $row_reading_time = $row["reading_time"];
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
      
        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));
      
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_usr . '</td> 
               <td>' . $row_sensor . '</td> 
                <td>' . $row_location . '</td> 
                <td>' . $row_value1 . '</td> 
                <td>' . $row_value2 . '</td>
                <td>' . $row_value3 . '</td> 
                <td>' . $row_reading_time . '</td> 
              </tr>';
    }
    $result->free();
}

$conn->close();
?> 
</table>
</body>
</html>



    <nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
	</nav>
		<div class="content">
            <h2>Home Page</h2>
          

			<p>Welcome back, <?=$_SESSION['name']?>!</p>
		</div>
	</body>
</html>
