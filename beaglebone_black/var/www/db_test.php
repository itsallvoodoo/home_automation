<?php
	error_reporting(E_ALL);
	echo 'hello1'. "<br>";
	include_once 'includes/db_connect.php';
	echo 'hello2'. "<br>";

	$test=2;
	if ($test>1){
		trigger_error("A custom error has been triggered");
	} 



	$sql="SELECT * FROM members";

	$result = mysqli_query($mysqli,$sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
	
	echo 'hello3';
	while($row = mysqli_fetch_array($result)) {
    	echo $row['id'] . "<br>";
    	echo $row['username'] . "<br>";
    	echo $row['email'] . "<br>";
    	echo $row['password'];
    }

?>
