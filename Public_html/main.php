<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="http://meteo.uwasa.fi/style/style.css" type="text/css" media="screen" />
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:light,regular,bold&amp;subset=latin' rel='stylesheet' type='text/css'/>

<script type="text/javascript">
	document.documentElement.className = 'js';
</script>

<script type='text/javascript' src='http://meteo.uwasa.fi/scripts/9.js'></script>
<script type='text/javascript' src='http://meteo.uwasa.fi/scripts/8.js'></script>
<script type='text/javascript' src='http://meteo.uwasa.fi/scripts/7.js'></script>
<script type='text/javascript' src='http://meteo.uwasa.fi/scripts/6.js'></script>
<!-- <meta name='Grand Flagallery' content='3.20' /> -->
<!-- used in scripts --><meta name="et_bg_image_speed" content="8000" /><meta name="et_service_image_speed" content="1000" /><meta name="et_disable_toptier" content="1" />		<style type="text/css">
				</style>
		<style type="text/css">
		#et_pt_portfolio_gallery { margin-left: -11px; }
		.et_pt_portfolio_item { margin-left: 23px; }
		.et_portfolio_small { margin-left: -39px !important; }
		.et_portfolio_small .et_pt_portfolio_item { margin-left: 31px !important; }
		.et_portfolio_large { margin-left: -20px !important; }
		.et_portfolio_large .et_pt_portfolio_item { margin-left: 6px !important; }
	</style>
<script src="../Chart.js"></script>
		<meta name = "viewport" content = "initial-scale = 1, user-scalable = no">
		<style>
			canvas{
			}
		</style>

</head>
<body class="page page-id-137 page-template-default et_dropcaps_enabled gecko et_includes_sidebar">
<div id="background">
		<div id="backgrounds">
			<img src="http://meteo.uwasa.fi/pics/4.jpg" alt=""/><img src="http://meteo.uwasa.fi/pics/2.jpg" alt=""/><img src="http://meteo.uwasa.fi/pics/1.jpg" alt=""/><img src="http://meteo.uwasa.fi/pics/5.jpg" alt=""/><img src="http://meteo.uwasa.fi/pics/3.jpg" alt=""/>		</div> <!-- end #backgrounds -->

	


<?php

// define variables and set to empty values
$dateErr = "";
$date = "";
$c = "1";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   if (empty($_POST["date"]))
     {$dateErr = "<br><br>Date is required";}
   else
     {
     $date = test_input($_POST["date"]);
     $date = mysql_real_escape_string($date);
     $timm = test_input($_POST["time"]);
     $timm = mysql_real_escape_string($timm);
     // check if date only contains numbers
     if (!preg_match("/([0-9]{2}).([0-9]{2}).([0-9]{2})$/",$date))
       {
       $dateErr = "<br><br>Only numbers are allowed, check the format";
	$c = "1";
       }
     else 
	{$c = "0";}
     }

}
function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}
?>
<div id="container">

<table border="0">
<tr>
<td colspan="2" style="text-align:left;">
<h1 class="title"><b><u>Meteoria Soderfjarden</u></b></h1>
</td>
</tr>
<tr>
<td style="width:600px;">
<b><h2 class="title">Select Time and Date:</h2></b><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<div>
<h6>Format:dd.mm.yy </h6><input type="date" name="date" value="<?php echo $date;?>">
<span class="error"> <?php echo $dateErr;?></span>
<select name="time">
<option value="00">00:00-01:00
<option value="01">01:00-02:00
<option value="02">02:00-03:00
<option value="03">03:00-04:00
<option value="04">04:00-05:00
<option value="05">05:00-06:00
<option value="06">06:00-07:00
<option value="07">07:00-08:00
<option value="08">08:00-09:00
<option value="09">09:00-10:00
<option value="10">10:00-11:00
<option value="11">11:00-12:00
<option value="12">12:00-13:00
<option value="13">13:00-14:00
<option value="14">14:00-15:00
<option value="15">15:00-16:00
<option value="16">16:00-17:00
<option value="17">17:00-18:00
<option value="18">18:00-19:00
<option value="19">19:00-20:00
<option value="20">20:00-21:00
<option value="21">21:00-22:00
<option value="22">22:00-23:00
<option value="23">23:00-24:00
</select>

<br><br><input type="submit" name="submit" value="Submit"><br><br>
</div></form>
<div>
<table border="3" bgcolor="white">

<tr align="center">

<th><blockquote><h5><b>Temperature</b></h5></blockquote></th>
<th><blockquote><h5><b>Pressure</b></h5></blockquote></th>
<th><blockquote><h5><b>Humidity</b></h5></blockquote></th>
<th><blockquote><h5><b>Date</b></h5></blockquote></th>
<th><blockquote><h5><b>Time</b></h5></blockquote></th>
</tr>
 <?php
$mcon=mysqli_connect("hhaq.no-ip.biz","root","ariag25","mydb");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$MaxID = mysqli_query($mcon, "SELECT MAX(Id) FROM `data11`");
$MaxID = mysqli_fetch_array($MaxID, MYSQL_BOTH);
$MaxID = $MaxID[0];


$mcon1=mysqli_connect("193.166.111.8","hhaq","y7xp9ua1","meteoriihi");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$MaxID1 = mysqli_query($mcon1, "SELECT MAX(Id) FROM `data2`");
$MaxID1 = mysqli_fetch_array($MaxID1, MYSQL_BOTH);
$MaxID1 = $MaxID1[0];


    while ($MaxID > $MaxID1)
{
   $result = mysqli_query($mcon,"SELECT * FROM data11 WHERE id=$MaxID1");

$row = mysqli_fetch_array($result);
  
  //echo $row['Wind_direction'];
  $wd[$j] = $row['Wind_direction'];
  $wd[$j] = mysql_real_escape_string($wd[$j]);

  //echo " " . $row['Wind_speed'];
  $ws[$j] = $row['Wind_speed'];
  $ws[$j] = mysql_real_escape_string($ws[$j]);

  //echo " " . $row['Temperature'];
  $tempp[$j] = $row['Temperature'];
  $tempp[$j] = mysql_real_escape_string($tempp[$j]);
  
  //echo " " . $row['Pressure'];
  $pressure[$j] = $row['Pressure'];
  $pressure[$j] = mysql_real_escape_string($pressure[$j]);
  
  //echo " " . $row['Humidity'];
  $humidity[$j] = $row['Humidity'];
  $humidity[$j] = mysql_real_escape_string($humidity[$j]);
  
  //echo " " . $row['Rain_accumulator'];
  $ra[$j] = $row['Rain_accumulator'];
  $ra[$j] = mysql_real_escape_string($ra[$j]);

  //echo " " . $row['Heating_temperature'];
  $ht[$j] = $row['Heating_temperature'];
  $ht[$j] = mysql_real_escape_string($ht[$j]);

  //echo " " . $row['Heating_voltage'];
  $hv[$j] = $row['Heating_voltage'];
  $hv[$j] = mysql_real_escape_string($hv[$j]);

  //echo " " . $row['Date'];
  $dates[$j] = $row['Date'];
  $dates[$j] = mysql_real_escape_string($dates[$j]);
  //echo " " . $row['Time'];
  $times[$j] = $row['Time'];
  $times[$j] = mysql_real_escape_string($times[$j]);
  $mcon1=mysqli_connect("193.166.111.8","hhaq","y7xp9ua1","meteoriihi");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $sql="INSERT INTO data2 (Wind_direction, Wind_speed, Temperature, Humidity, Pressure, Rain_accumulator, Heating_temperature, Heating_voltage, Date, Time)
VALUES
('$wd[$j]','$ws[$j]','$tempp[$j]','$humidity[$j]','$pressure[$j]','$ra[$j]','$ht[$j]','$hv[$j]','$dates[$j]','$times[$j]')";

if (!mysqli_query($mcon1,$sql))
  {
  die('Error: ' . mysqli_error($mcon1));
  }
  
$MaxID1 = mysqli_query($mcon1, "SELECT MAX(Id) FROM `data2`");
$MaxID1 = mysqli_fetch_array($MaxID1, MYSQL_BOTH);
$MaxID1 = $MaxID1[0];


  $j++;
  
}
   
$temp = array(); 
$press = array(); 
$hum = array(); 
$dat = array(); 
$tim = array(); 
$temp1 = array(); 
$press1 = array(); 
$hum1 = array(); 
$dir = array();
$htt = array();
$j = 0;
$con=mysqli_connect("193.166.111.8","hhaq","y7xp9ua1","meteoriihi");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if ($c == "0")
{
$temp = array(); 
$press = array(); 
$hum = array(); 
$dat = array(); 
$tim = array(); 
$temp1 = array(); 
$press1 = array(); 
$hum1 = array(); 
$dir = array();
$htt = array();
$j = 0;
echo "<b>Requested data:</b>";
echo "<br>";
$con=mysqli_connect("193.166.111.8","hhaq","y7xp9ua1","meteoriihi");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$result = mysqli_query($con,"SELECT * FROM data2 WHERE Date='$date' AND (LEFT(Time, 2))='$timm'");

while($row = mysqli_fetch_array($result))
  {
  //echo $row['Temperature'];
  $temp[$j] = $row['Temperature'];
  $temp1[$j] = floatval($temp[$j]);
  //echo " " . $row['Pressure'];
  $press[$j] = $row['Pressure'];
  $press1[$j] = floatval($press[$j]);
  //echo " " . $row['Humidity'];
  $hum[$j] = $row['Humidity'];
  $hum1[$j]= floatval($hum[$j]);
  $dir[$j] = $row['Wind_direction'];
  $dir[$j]= floatval($dir[$j]);
  $htt[$j] = $row['Heating_temperature'];
  $htt[$j]= floatval($htt[$j]);
  //echo " " . $row['Date'];
  $dat[$j] = $row['Date'];
  //echo " " . $row['Time'];
  $tim[$j] = $row['Time'];
  //echo "<br>";
  $j++;
  }
}
else
{
$result = mysqli_query($con,"SELECT * FROM data2 ORDER BY id DESC LIMIT 6");

while($row = mysqli_fetch_array($result))
  {
  //echo $row['Temperature'];
  $temp[$j] = $row['Temperature'];
  $temp1[$j] = floatval($temp[$j]);
  //echo " " . $row['Pressure'];
  $press[$j] = $row['Pressure'];
  $press1[$j] = floatval($press[$j]);
  //echo " " . $row['Humidity'];
  $hum[$j] = $row['Humidity'];
  $hum1[$j]= floatval($hum[$j]);
  $dir[$j] = $row['Wind_direction'];
  $dir[$j]= floatval($dir[$j]);
  $htt[$j] = $row['Heating_temperature'];
  $htt[$j]= floatval($htt[$j]);
  //echo " " . $row['Date'];
  $dat[$j] = $row['Date'];
  //echo " " . $row['Time'];
  $tim[$j] = $row['Time'];
  //echo "<br>";
  $j++;
  }
}
$temp[$j] = '/0'; 
$press[$j] = '/0'; 
$hum[$j] = '/0';
$dat[$j] = '/0';
$tim[$j] = '/0';
$temp1[$j] = '/0'; 
$press1[$j] = '/0'; 
$hum1[$j] = '/0';
$dir[$j] = '/0'; 
$htt[$j] = '/0'; 
mysqli_close($con);
?>


<tr align="center">
<td><h6><?php echo $temp[5]; ?></h6></td>
<td><h6><?php echo $press[5]; ?></h6></td>
<td><h6><?php echo $hum[5]; ?></h6></td>
<td><h6><?php echo $dat[5]; ?></h6></td>
<td><h6><?php echo $tim[5]; ?></h6></td>
</tr>
<tr align="center">
<td><h6><?php echo $temp[4]; ?></h6></td>
<td><h6><?php echo $press[4]; ?></h6></td>
<td><h6><?php echo $hum[4]; ?></h6></td>
<td><h6><?php echo $dat[4]; ?></h6></td>
<td><h6><?php echo $tim[4]; ?></h6></td>
</tr>
<tr align="center">
<td><h6><?php echo $temp[3]; ?></h6></td>
<td><h6><?php echo $press[3]; ?></h6></td>
<td><h6><?php echo $hum[3]; ?></h6></td>
<td><h6><?php echo $dat[3]; ?></h6></td>
<td><h6><?php echo $tim[3]; ?></h6></td>
</tr>
<tr align="center">
<td><h6><?php echo $temp[2]; ?></h6></td>
<td><h6><?php echo $press[2]; ?></h6></td>
<td><h6><?php echo $hum[2]; ?></h6></td>
<td><h6><?php echo $dat[2]; ?></h6></td>
<td><h6><?php echo $tim[2]; ?></h6></td>
</tr>
<tr align="center">
<td><h6><?php echo $temp[1]; ?></h6></td>
<td><h6><?php echo $press[1]; ?></h6></td>
<td><h6><?php echo $hum[1]; ?></h6></td>
<td><h6><?php echo $dat[1]; ?></h6></td>
<td><h6><?php echo $tim[1]; ?></h6></td>
</tr>
<tr align="center">
<td><h6><?php echo $temp[0]; ?></h6></td>
<td><h6><?php echo $press[0]; ?></h6></td>
<td><h6><?php echo $hum[0]; ?></h6></td>
<td><h6><?php echo $dat[0]; ?></h6></td>
<td><h6><?php echo $tim[0]; ?></h6></td>

</tr>

</table> 
</div>

</td>

<td style="height:750px;width:600px;">
<div><blockquote><h4><b>Temperature & Pressure</b></h4></blockquote></div>
<canvas id="canvas" height="350" width="600"></canvas>

<script>

		var lineChartData = {
			labels : ["<?php echo $tim[5]; ?>","<?php echo $tim[4]; ?>","<?php echo $tim[3]; ?>","<?php echo $tim[2]; ?>","<?php echo $tim[1]; ?>","<?php echo $tim[0]; ?>"],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					data : [<?php echo $press1[5]; ?>,<?php echo $press1[4]; ?>,<?php echo $press1[3]; ?>,<?php echo $press1[2]; ?>,<?php echo $press1[1]; ?>,<?php echo $press1[0]; ?>]
				},
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : [<?php echo $temp1[5]; ?>,<?php echo $temp1[4]; ?>,<?php echo $temp1[3]; ?>,<?php echo $temp1[2]; ?>,<?php echo $temp1[1]; ?>,<?php echo $temp1[0]; ?>]
				}
			]
			
		}

	var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
	
	</script>
<br>
<div><blockquote><h4><b>Wind Direction & Heating Temperature</b></h4></blockquote></div>
<canvas id="canvas1" height="350" width="600"></canvas>

<script>

		var lineChartData = {
			labels : ["<?php echo $tim[5]; ?>","<?php echo $tim[4]; ?>","<?php echo $tim[3]; ?>","<?php echo $tim[2]; ?>","<?php echo $tim[1]; ?>","<?php echo $tim[0]; ?>"],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					data : [<?php echo $dir[5]; ?>,<?php echo $dir[4]; ?>,<?php echo $dir[3]; ?>,<?php echo $dir[2]; ?>,<?php echo $dir[1]; ?>,<?php echo $dir[0]; ?>]
				},
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : [<?php echo $htt[5]; ?>,<?php echo $htt[4]; ?>,<?php echo $htt[3]; ?>,<?php echo $htt[2]; ?>,<?php echo $htt[1]; ?>,<?php echo $htt[0]; ?>]
				}
			]
			
		}

	var myLine = new Chart(document.getElementById("canvas1").getContext("2d")).Line(lineChartData);
	
	</script>

</td>
</tr>

<tr><br>
<td colspan="2" style="text-align:center;">
<div><h6 class="category-title"><b>Design by Hafiz Haq --> Hafiz.haq@uwasa.fi</b></h6></div></td>
</tr>
</div>
</table>

<script type="text/javascript" src="meteo.uwasa.fi/scripts/5.js"></script>
<script type="text/javascript" src="http://meteo.uwasa.fi/scripts/4.js"></script>	<script type='text/javascript' src='http://meteo.uwasa.fi/scripts/3.js'></script>
<script type='text/javascript' src='http://meteo.uwasa.fi/scripts/2.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var et_ptemplates_strings = {"captcha":"Captcha","fill":"Fill","field":"field","invalid":"Invalid email"};
/* ]]> */
</script>
<script type='text/javascript' src='http://meteo.uwasa.fi/scripts/1.js'></script>
</body>
</html>

