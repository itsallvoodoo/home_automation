<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        	<ul>
            <li class="menuitem"><a href="/index.html">Home</a></li>
            <li class="menuitem"><a href="/access/access.php">Access Control</a></li>
            <li class="menuitem"><a href="/security/security.php">Security</a></li>
            <li class="menuitem"><a href="/hvac/hvac.php">HVAC</a></li>
            </ul>
        </div>
        
        <div id="leftmenu">

        <div id="leftmenu_top"></div>

				<div id="leftmenu_main">    
                
                <h3>Links</h3>
                        
                <ul>
                    <li><a href="#">Side1</a></li>
                    <li><a href="#">Side2</a></li>
                    <li><a href="#">Side3</a></li>
                    <li><a href="#">Side4</a></li>

                </ul>
</div>
                
                
              <div id="leftmenu_bottom"></div>
        </div>
        
        
        
        
		<div id="content">
        
        
        <div id="content_top"></div>
        <div id="content_main">
        	<h2>HVAC System Page</h2>

            <?php

                $con = mysqli_connect('localhost','tempsensor','sensorpassword','homedb');
                if (!$con) {
                    die('Could not connect: ' . mysqli_error($con));
                }

                mysqli_select_db($con,"homedb");
                $sql="SELECT tempEntry FROM tempdata ORDER BY tempId DESC LIMIT 1";

                $result = mysqli_query($con,$sql);

                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Current Temperature</th>";
                echo "</tr>";

                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td align=\"center\">" . $row['tempEntry'] . " F</td>";
                    echo "</tr>";
                    }
                echo "</table>";

                mysqli_close($con);
            ?> 
        	<p>&nbsp;</p>
           	<p>&nbsp;</p>
        	<p>This website is being served from a Beaglebone Black and is the same device that controls various functions around the house.</p>
        	<p>&nbsp;</p>
            <p>&nbsp;</p>
</div>
        <div id="content_bottom"></div>
            
            <div id="footer"><h3>Footer Stuff</h3></div>
      </div>
   </div>
</body>
</html>
