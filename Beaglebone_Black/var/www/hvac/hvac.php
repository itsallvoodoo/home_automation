<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="Chart.js"></script>
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

                echo "<table>";
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
            <canvas id="myChart" width="400" height="400"></canvas>

            <script>
            
                //Get the context of the canvas element we want to select
                var ctx = document.getElementById("myChart").getContext("2d");
                var myNewChart = new Chart(ctx).Line(data,options);

                var data = {
                    labels : ["January","February","March","April","May","June","July"],
                    datasets : [
                        {
                            fillColor : "rgba(220,220,220,0.5)",
                            strokeColor : "rgba(220,220,220,1)",
                            pointColor : "rgba(220,220,220,1)",
                            pointStrokeColor : "#fff",
                            data : [65,59,90,81,56,55,40]
                        },
                        {
                            fillColor : "rgba(151,187,205,0.5)",
                            strokeColor : "rgba(151,187,205,1)",
                            pointColor : "rgba(151,187,205,1)",
                            pointStrokeColor : "#fff",
                            data : [28,48,40,19,96,27,100]
                        }
                    ]
                }

                Line.defaults = {
                    
                    //Boolean - If we show the scale above the chart data           
                    scaleOverlay : false,
                    
                    //Boolean - If we want to override with a hard coded scale
                    scaleOverride : false,
                    
                    //** Required if scaleOverride is true **
                    //Number - The number of steps in a hard coded scale
                    scaleSteps : null,
                    //Number - The value jump in the hard coded scale
                    scaleStepWidth : null,
                    //Number - The scale starting value
                    scaleStartValue : null,

                    //String - Colour of the scale line 
                    scaleLineColor : "rgba(0,0,0,.1)",
                    
                    //Number - Pixel width of the scale line    
                    scaleLineWidth : 1,

                    //Boolean - Whether to show labels on the scale 
                    scaleShowLabels : true,
                    
                    //Interpolated JS string - can access value
                    scaleLabel : "<%=value%>",
                    
                    //String - Scale label font declaration for the scale label
                    scaleFontFamily : "'Arial'",
                    
                    //Number - Scale label font size in pixels  
                    scaleFontSize : 12,
                    
                    //String - Scale label font weight style    
                    scaleFontStyle : "normal",
                    
                    //String - Scale label font colour  
                    scaleFontColor : "#666",    
                    
                    ///Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines : true,
                    
                    //String - Colour of the grid lines
                    scaleGridLineColor : "rgba(0,0,0,.05)",
                    
                    //Number - Width of the grid lines
                    scaleGridLineWidth : 1, 
                    
                    //Boolean - Whether the line is curved between points
                    bezierCurve : true,
                    
                    //Boolean - Whether to show a dot for each point
                    pointDot : true,
                    
                    //Number - Radius of each point dot in pixels
                    pointDotRadius : 3,
                    
                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth : 1,
                    
                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke : true,
                    
                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth : 2,
                    
                    //Boolean - Whether to fill the dataset with a colour
                    datasetFill : true,
                    
                    //Boolean - Whether to animate the chart
                    animation : true,

                    //Number - Number of animation steps
                    animationSteps : 60,
                    
                    //String - Animation easing effect
                    animationEasing : "easeOutQuart",

                    //Function - Fires when the animation is complete
                    onAnimationComplete : null
                }


            </script>

</div>
        <div id="content_bottom"></div>
            
            <div id="footer"><h3>Footer Stuff</h3></div>
      </div>
   </div>
</body>
</html>
