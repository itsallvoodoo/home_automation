<?php
    require '../includes/db_secure_connect.php';
    require '../includes/functions.php';
 
    sec_session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Hobbs Home Automation Server</title>
</head>

<body>
<div id="container">
	<div id="header">
       	<h1>Hobbs Home Automation Server</span></h1>
        <h2></h2>
    </div>   
        
    <div id="menu">
        <ul>
           	<li class="menuitem"><a href="/index.php">Home</a></li>
            <li class="menuitem"><a href="/access/access.php">Access Control</a></li>
            <li class="menuitem"><a href="/security/security.php">Security</a></li>
            <li class="menuitem"><a href="/hvac/hvac.php">HVAC</a></li>
        </ul>
    </div>
        
    <div id="leftmenu">

    <div id="leftmenu_top">
    </div>

		<div id="leftmenu_main">    
            
            <h3>Links</h3>
                    
            <ul>
                <?php if (login_check($mysqli) == true) : ?>
                    <li><a href="logout.php">Log out</a></li>
                <?php else : ?>
                    <li><a href="login.php">Log in</a></li>
                <?php endif; ?>    
                <li><a href="#">Side2</a></li>
                <li><a href="#">Side3</a></li>
                <li><a href="#"></a></li>

            </ul>
        </div>
            
        <div id="leftmenu_bottom">
        </div>
    </div>
          
	<div id="content">
            
        <div id="content_top"></div>
        <div id="content_main">

            <?php if (login_check($mysqli) == true) : ?>
                <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
                <p>
                    This is an example protected page.  To access this page, users
                    must be logged in.  At some stage, we'll also check the role of
                    the user, so pages will be able to determine the type of user
                    authorised to access the page.
                </p>

            <p>Return to <a href="index.php">login page</a></p>
        <?php else : ?>
        	<h2>Welcome to Chad's Home Automation Server </h2>
        	<p>&nbsp;</p>
           	<p>&nbsp;</p>
        	<p>This website is being served from a Beaglebone Black and is the same device that controls various functions around the house.</p>
        	<p>&nbsp;</p>
            <p>&nbsp;</p>
        <?php endif; ?>

        </div>
        <div id="content_bottom"></div>
            
        <div id="footer"><h3>Footer Stuff</h3></div>
    </div>
</div>
</body>
</html>