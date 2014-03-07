<?php 
    if (login_check($mysqli) == true) :
                
        include_once '../includes/db_temp_connect.php';

        $sql="SELECT tempEntry FROM tempdata ORDER BY tempId DESC LIMIT 1";

        $result = mysqli_query($mysqli,$sql);
?>
    
        <table>
            <tr>
                <th>Current Temperature</th>
                <th>Lower Setpoint</th>
                <th>Upper Setpoint</th>
            </tr>
            <tr>
                <td></td>
                <td><button type="button"  onclick="testFunction()">Increase</button></td>
                <td><button type="button"  onclick="testFunction()">Increase</button></td>
            </tr>

<?php
            while($row = mysqli_fetch_array($result)) {
                $current_temp = $row['tempEntry'];
            }
            $sql="SELECT * FROM tempSetpoint ORDER BY setpointId DESC LIMIT 1";

            $result = mysqli_query($mysqli,$sql);
            
            while($row = mysqli_fetch_array($result)) {
                $lower = $row['lower'];
                $upper = $row['upper'];
            }
?>
            <tr>
<?php
            echo '<td align="center">' . $current_temp . 'F</td>';
            echo '<td align="center">' . $lower . 'F</td>';
            echo '<td align="center">' . $upper . 'F</td>';
?>
            </tr>
            <tr>
                <td></td>
                <td><button type="button"  onclick="testFunction()">Decrease</button></td>
                <td><button type="button"  onclick="testFunction()">Decrease</button></td>
            </tr>
      
        </table>

<?php
        $sql="SELECT * FROM (SELECT * FROM tempdata ORDER BY tempId DESC LIMIT 15) AS `table` ORDER BY tempId ASC";

        $result = mysqli_query($mysqli,$sql);

        echo '<p>&nbsp;</p><canvas id="canvas" height="450" width="600"></canvas>';

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

        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="../login.php">login</a>.
            </p>
        <?php endif; ?>      