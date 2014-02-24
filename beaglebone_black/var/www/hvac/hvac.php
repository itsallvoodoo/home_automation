<?php
    include_once '../includes/db_connect.php';
    include_once '../includes/functions.php';
 
    sec_session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../js/Chart/Chart.js"></script>
<meta name = "viewport" content = "initial-scale = 1, user-scalable = no">
        <style>
            canvas{
            }
        </style>
<link rel="stylesheet" type="text/css" href="/style.css" />
<title>Hobbs Home Automation Server</title>
</head>

<body>

<div id="container">
		<div id="header">
        	<h1>Hobbs Home Automation Server</span></h1>
            <h2>HVAC Control</h2>
        </div>   
        
        <div id="menu">
        	<?php include '../top_menu.php'; ?>
        </div>
        
        <div id="leftmenu">

        <div id="leftmenu_top"></div>

				<div id="leftmenu_main">    
                    <?php include '../leftmenu_main.php'; ?>
                </div>
                
                
              <div id="leftmenu_bottom"></div>
        </div>
               
		<div id="content">
        
        
        <div id="content_top"></div>
        <div id="content_main">
        	<h2>HVAC System Page</h2>

            <?php include 'tempData.php'; ?>          

</div>
        <div id="content_bottom"></div>
            
            <div id="footer"><h3>Footer Stuff</h3></div>
      </div>
   </div>
</body>
</html>
