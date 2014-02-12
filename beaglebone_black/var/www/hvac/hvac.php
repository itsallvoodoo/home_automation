<?php
    include_once '../includes/db_connect.php';
    include_once '../includes/functions.php';
 
    sec_session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../js/chart/Chart.js"></script>
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


            <?php if (login_check($mysqli) == true) :
                
                        include_once '../includes/db_temp_connect.php';

                        $sql="SELECT tempEntry FROM tempdata ORDER BY tempId DESC LIMIT 1";

                        $result = mysqli_query($mysqli,$sql);

                        echo "
                            <table>
                            <tr>
                            <th>Current Temperature</th>
                            </tr>";

                        while($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td align=\"center\">" . $row['tempEntry'] . "F</td>";
                            echo "</tr>";
                            }
                        echo "</table>";

                        $sql="SELECT * FROM (SELECT * FROM tempdata ORDER BY tempId DESC LIMIT 10) AS `table` ORDER BY tempId ASC";

                        $result = mysqli_query($mysqli,$sql);
                
                    ?> 
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <canvas id="canvas" height="450" width="600"></canvas>

                    <script>

                        

                        var lineChartData = {
                            labels : [ <?php

                                $initial = True;

                                while ($row = mysqli_fetch_array($result)) {
                                    if ($initial == False)  {
                                        echo ',';
                                    }
                                    echo '"' . date('H:i', strtotime($row['tempTime'])) . '"';
                                    $initial = False;
                                }
                            ?>],
                            datasets : [
                                {
                                    fillColor : "rgba(220,220,220,0.5)",
                                    strokeColor : "rgba(220,220,220,1)",
                                    pointColor : "rgba(220,220,220,1)",
                                    pointStrokeColor : "#fff",
                                    data : [<?php
                                                $initial = True;
                                                $result = mysqli_query($mysqli,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    if ($initial == False)  {
                                                        echo ',';
                                                    }
                                                    echo round($row['tempEntry'],2);
                                                    $initial = False;
                                                }
                                                mysqli_close($con);  
                                    ?>]
                                }
                            ]
                            
                        }

                        var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
                    
                    </script>

            <?php else : ?>
                <p>
                    <span class="error">You are not authorized to access this page.</span> Please <a href="../login.php">login</a>.
                </p>
            <?php endif; ?>                

</div>
        <div id="content_bottom"></div>
            
            <div id="footer"><h3>Footer Stuff</h3></div>
      </div>
   </div>
</body>
</html>
