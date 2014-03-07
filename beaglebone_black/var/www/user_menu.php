<?php

    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
    
    if (login_check($mysqli) == true) :
?>
        <li><a href="/includes/logout.php">Log out</a></li>
        <li><a href="#">Account</a></li>
<?php
    else :
?>
        <li><a href="/login.php">Log in</a></li>
        <li><a href="/register.php">Create Account</a></li>
<?php
	endif;
?>
	
    <li><a href="#">Help</a></li>
