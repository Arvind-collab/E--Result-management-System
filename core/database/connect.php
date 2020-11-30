<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password,'e_access');
$conn1 = mysqli_connect($servername, $username, $password,'result');
// Check connection
	if (!$conn)
	   die("Connection failed: " . mysqli_connect_error());
   if (!$conn1)
	   die("Connection failed: " . mysqli_connect_error());
?>