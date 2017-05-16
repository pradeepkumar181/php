
<!--Show Duplicate Record Togather-->

<?php
    
    include 'index.php';
    include 'Config.php';

     echo "<center>";
            echo "<h2 align='center'>Doctor Data</h2>";
            echo "<strong> Duplicate Data Grouped Togather </strong>"; 
         
     echo "<br><br>";

     echo "<table border='1'>
        <tr align='center'>
            <th>Doctor_Name </th>      <th>Hospital_Name </th>     <th>Qualification</th>    <th>Location</th>    <th>Last_Updated</th>
        </tr>"; 

    $res=mysqli_query($conn, "SELECT * from doctor ORDER BY Doctor_Name, Hospital_Name, Qualification, Location");
         
         echo "<tr><td colspan='5'></td></tr>";
         while($row=mysqli_fetch_array($res))
         {
                 echo "<tr>";
                 echo "<td align='center'>". $row['Doctor_Name'] ."</td>";
                 echo "<td width='200'>". $row['Hospital_Name'] ."</td>";
                 echo "<td align='center' width='40'>". $row['Qualification'] ."</td>";
                 echo "<td align='center' width='200'>". $row['Location'] ."</td>";
                 echo "<td width='100' align='center'>". $row['Last_Updated'] ."</td>";
                 echo "</tr>";
        }

        echo "</table>";
 echo "</center>";

?>