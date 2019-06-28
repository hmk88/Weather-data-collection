<?php
$mcon=mysqli_connect("hhaq.no-ip.biz","root","ariag25","mydb");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$MaxIT = mysqli_query($mcon, "SELECT MAX(time) FROM `dbt1`");
$MaxIT = mysqli_fetch_array($MaxIT, MYSQL_BOTH);
$MaxIT = $MaxIT[0];


$mcon1=mysqli_connect("193.166.111.8","hhaq","y7xp9ua1","meteoriihi");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$MaxIT1 = mysqli_query($mcon1, "SELECT MAX(time) FROM `dbt1`");
$MaxIT1 = mysqli_fetch_array($MaxIT1, MYSQL_BOTH);
$MaxIT1 = $MaxIT1[0];


    while ($MaxIT != $MaxIT1)
{
   $result = mysqli_query($mcon,"SELECT * FROM dbt1");

$row = mysqli_fetch_array($result);
  
  echo $row['Wind_direction'];
  $wd[$j] = $row['Wind_direction'];
  $wd[$j] = mysql_real_escape_string($wd[$j]);

  echo " " . $row['Wind_speed'];
  $ws[$j] = $row['Wind_speed'];
  $ws[$j] = mysql_real_escape_string($ws[$j]);

  echo " " . $row['Temperature'];
  $tempp[$j] = $row['Temperature'];
  $tempp[$j] = mysql_real_escape_string($tempp[$j]);
  
  echo " " . $row['Pressure'];
  $pressure[$j] = $row['Pressure'];
  $pressure[$j] = mysql_real_escape_string($pressure[$j]);
  
  echo " " . $row['Humidity'];
  $humidity[$j] = $row['Humidity'];
  $humidity[$j] = mysql_real_escape_string($humidity[$j]);
  
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
  $dates[$j] = $row['Date'];
  $dates[$j] = mysql_real_escape_string($dates[$j]);
  echo " " . $row['Time'];
  $times[$j] = $row['Time'];
  $times[$j] = mysql_real_escape_string($times[$j]);
  $mcon1=mysqli_connect("193.166.111.8","hhaq","y7xp9ua1","meteoriihi");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $sql="INSERT INTO dbt1 (Wind_direction, Wind_speed, Temperature, Humidity, Pressure, Rain_accumulator, Heating_temperature, Heating_voltage, Date, Time)
VALUES
('$wd[$j]','$ws[$j]','$tempp[$j]','$humidity[$j]','$pressure[$j]','$ra[$j]','$ht[$j]','$hv[$j]','$dates[$j]','$times[$j]')";

if (!mysqli_query($mcon1,$sql))
  {
  die('Error: ' . mysqli_error($mcon1));
  }
  
$MaxIT1 = mysqli_query($mcon1, "SELECT MAX(time) FROM `dbt1`");
$MaxIT1 = mysqli_fetch_array($MaxIT1, MYSQL_BOTH);
$MaxIT1 = $MaxIT1[0];


  $j++;
  
}
?>
