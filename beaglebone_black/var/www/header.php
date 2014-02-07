<?php

	$con = mysqli_connect('localhost','tempsensor','sensorpassword','homedb');
    if (!$con) {
    	die('Could not connect: ' . mysqli_error($con));
    }

    mysqli_select_db($con,"homedb");


?>