<?php

    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
?>    
    <h3>Links</h3>       
    <ul>
<?php
    if (login_check($mysqli) == true) :
?>
        <li><a href="/includes/logout.php">Log out</a></li>
<?php
    else :
?>
        <li><a href="/login.php">Log in</a></li>
<?php
	endif;
?>
	<li><a href="#">Side2</a></li>
    <li><a href="#">Side3</a></li>
    <li><a href="#"></a></li>
	</ul>
