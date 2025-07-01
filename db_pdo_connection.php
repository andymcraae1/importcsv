<?php 
try{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$dbuser = "root";
	$dbpass = "";
	$dbhost ="mysql:host=localhost;dbname=my_database;charset=utf8mb4";
	$connect_token_pdo = new PDO($dbhost, $dbuser, $dbpass, $pdo_options);
}catch(Exception $e){		
	print "Error!: " . $e->getMessage() . "<br/>";
	die('Error : '.$e->getMessage());
}
?>