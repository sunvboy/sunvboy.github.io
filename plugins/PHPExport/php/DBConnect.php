<?php
//DBConnect.php

$error = "";

$dbHost = 'localhost';
$dbUser = 'root'; //Change to another user if you are using one
$dbPassWord = ''; //Change to another password if you are using one
$dataBase = 'exportphpdb'; //If you installed the scripts as another db then change this

$conn = mysqli_connect($dbHost,$dbUser,$dbPassWord,$dataBase);

// Check connection
$error = $conn->connect_error;

if (empty($error)) {
	$selectAllSQL="SELECT SQL_NO_CACHE * FROM customers;";
	$results=$conn->query($selectAllSQL);
	if ($conn->error){
		$error = $conn->error;
	}else{
		if($results){
			if($results->num_rows === 0)
				$error = "No results returned.";
		}
	}
}
$time = gettimeofday(); 
$filetime = $time["sec"]; //For file name
mysqli_close($conn);
?>