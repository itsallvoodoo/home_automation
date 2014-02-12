<?php

    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
    
    echo 	"<h3>Links</h3>       
    		<ul>";
    if (login_check($mysqli) == true) :
    	echo '        <li><a href="/includes/logout.php">Log out</a></li>';
    else :
    	echo '        <li><a href="/login.php">Log in</a></li>';
	endif;
    echo ' 	
    	<li><a href="#">Side2</a></li>
        <li><a href="#">Side3</a></li>
        <li><a href="#"></a></li>
		</ul>
	';
?>