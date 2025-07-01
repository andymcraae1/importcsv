<?php
	$dbhost = "localhost";
	$dbname = "my_database";
	$dbuser = "root";
	$dbpass = "";
	$connect_token = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if($connect_token ->ping()){
	}else{
		die("Failed to connect to admin Portal");
	}
?>