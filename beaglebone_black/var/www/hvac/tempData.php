<?php 
    if (login_check($mysqli) == true) :
                
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

    $sql="SELECT * FROM (SELECT * FROM tempdata ORDER BY tempId DESC LIMIT 15) AS `table` ORDER BY tempId ASC";

    $result = mysqli_query($mysqli,$sql);

    echo '<p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <canvas id="canvas" height="450" width="600"></canvas>';

    ?>
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

            <?php else :
                echo '<p>
                    <span class="error">You are not authorized to access this page.</span> Please <a href="../login.php">login</a>.
                    </p>';
                endif; 
            ?>      