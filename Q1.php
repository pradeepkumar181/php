
<!-- Record of all the doctors associated with a particular hospital within the 30 day limit.-->

<?php   
    include 'index.php';
    include 'Config.php';
?>
 <html>
 <body>
     <form name="DoctorDetails_hospitalName" method="post" action="Q1.php">
     <center>
            <h2 align="center">Doctor Data</h2>
         
            <strong> Select Hospital Name : </strong> 
            <select name="HospitalName" id="HospitalName"> 
               <option value=""> -----------ALL----------- </option> 
            <?php
  
                 $hosp_name=mysqli_query($conn, "SELECT DISTINCT Hospital_Name from doctor");
                 while($result=$hosp_name->fetch_assoc())
                 { 
                  
                  echo "<option value=\"$result[Hospital_Name]\">" .$result[Hospital_Name]. "</option>";     
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
         
         if($h_name=="")  
         { 
             $res=mysqli_query($conn, "SELECT * from doctor");
         }
         else
         { 
           
             $res=mysqli_query($conn, "SELECT * FROM doctor WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= Last_Updated and Hospital_Name='".$h_name."'");            
         }

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

    }
?>
  </table>
 </center>
</form>
</body>
</html>