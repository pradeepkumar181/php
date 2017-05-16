
<!--Record of Doctor Working in Same Hospital at same place.-->


<?php
    $servername = "localhost";
    $username = "root";
    $password = "gautam";
    $dbname="Doctor";
    include 'index.php';

    $conn = new mysqli($servername, $username, $password,$dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
?>
<html>
<body>
    <form name="DoctorDetails" method="post" action="Q2.php">
    <center>
            <h2 align="center">Doctor Data</h2>
         
            <strong> Select Hospital Name : </strong> 
            <select name="HospitalName" id="HospitalName"> 
                <option value=""> -----------ALL----------- </option> 
            <?php
  
                 $result=mysqli_query($conn, "SELECT DISTINCT Hospital_Name from doctor");
                 while($row=$result->fetch_assoc())
                 {                   
                  echo "<option value=\"$row[Hospital_Name]\">" .$row[Hospital_Name]. "</option>";     
                 }                
            ?>
            </select>

            <strong> Location : </strong> 
            <select name="location" id="location"> 
               <option value=""> -----------ALL----------- </option> 
            <?php
  
                $result=mysqli_query($conn, "SELECT DISTINCT Location from doctor");
                while($row=$result->fetch_assoc())
                {                  
                  echo "<option value=\"$row[Location]\">" .$row[Location]. "</option>";     
                }
            ?>
            </select>


    <input type="submit" name="Show" value="Show"/> 
    <br><br>

<table border="1">
    <tr align="center">
        <th>Doctor_Name </th>      <th>Hospital_Name </th>     <th>Qualification</th>    <th>Location</th>    <th>Last_Updated</th>
    </tr> 
 
<?php
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
         $h_name=$_POST['HospitalName']; 
         $loca=$_POST['location'];
         
         if($h_name=="")  
         { 
             $result=mysqli_query($conn, "SELECT * from doctor");
         }
         else
         { 
             $result=mysqli_query($conn, "SELECT * FROM doctor WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= Last_Updated and Hospital_Name='".$h_name."'and Location='".$loca."'"); 
                        
         }

         echo "<tr><td colspan='5'></td></tr>";
         while($row=mysqli_fetch_array($result))
         {
                 echo "<tr>";
                 echo "<td align='center'>". $row['Doctor_Name'] ."</td>";
                 echo "<td width='200'>". $row['Hospital_Name'] ."</td>";
                 echo "<td align='center' width='40'>". $row['Qualification'] ."</td>";
                 echo "<td align='center' width='200'>". $row['Location'] ."</td>";
                 echo "<td width='100' align='center'>". $row['Last_Updated'] ."</td>";
                 echo "</tr>";
        }

    }
?>
  </table>
 </center>
</form>
</body>
</html>