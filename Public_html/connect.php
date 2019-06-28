 <?php
$wd = array();
$ws = array();
$temp = array(); 
$press = array(); 
$hum = array(); 
$ra = array();
$ht = array();
$hv = array();
$date = array(); 
$time = array(); 
$j = 0;
$con=mysqli_connect("81.197.176.92","root","ariag25","mydb");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$result = mysqli_query($con,"SELECT * FROM data11");

while($row = mysqli_fetch_array($result))
  {
  echo $row['Wind_direction'];
  $wd[$j] = $row['Wind_direction'];
  $wd[$j] = mysql_real_escape_string($wd[$j]);

  echo " " . $row['Wind_speed'];
  $ws[$j] = $row['Wind_speed'];
  $ws[$j] = mysql_real_escape_string($ws[$j]);

  echo " " . $row['Temperature'];
  $temp[$j] = $row['Temperature'];
  $temp[$j] = mysql_real_escape_string($temp[$j]);
  
  echo " " . $row['Pressure'];
  $press[$j] = $row['Pressure'];
  $press[$j] = mysql_real_escape_string($press[$j]);
  
  echo " " . $row['Humidity'];
  $hum[$j] = $row['Humidity'];
  $hum[$j] = mysql_real_escape_string($hum[$j]);
  
  echo " " . $row['Rain_accumulator'];
  $ra[$j] = $row['Rain_accumulator'];
  $ra[$j] = mysql_real_escape_string($ra[$j]);

  echo " " . $row['Heating_temperature'];
  $ht[$j] = $row['Heating_temperature'];
  $ht[$j] = mysql_real_escape_string($ht[$j]);

  echo " " . $row['Heating_voltage'];
  $hv[$j] = $row['Heating_voltage'];
  $hv[$j] = mysql_real_escape_string($hv[$j]);

  echo " " . $row['Date'];
  $date[$j] = $row['Date'];
  $date[$j] = mysql_real_escape_string($date[$j]);
  echo " " . $row['Time'];
  $time[$j] = $row['Time'];
  $time[$j] = mysql_real_escape_string($time[$j]);
  $con1=mysqli_connect("193.166.111.8","hhaq","y7xp9ua1","meteoriihi");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $sql="INSERT INTO data2 (Wind_direction, Wind_speed, Temperature, Humidity, Pressure, Rain_accumulator, Heating_temperature, Heating_voltage, Date, Time)
VALUES
('$wd[$j]','$ws[$j]','$temp[$j]','$hum[$j]','$press[$j]','$ra[$j]','$ht[$j]','$hv[$j]','$date[$j]','$time[$j]')";

if (!mysqli_query($con1,$sql))
  {
  die('Error: ' . mysqli_error($con1));
  }
  mysqli_close($con1);
  echo "<br>";
  $j++;
  }
$temp[$j] = '/0'; 
$press[$j] = '/0'; 
$hum[$j] = '/0';
$date[$j] = '/0';
$time[$j] = '/0';


mysqli_close($con);

?>


