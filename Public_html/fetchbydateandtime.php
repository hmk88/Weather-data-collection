<!DOCTYPE html>
<html>
<body>

<?php

// define variables and set to empty values
$dateErr = "";
$date = "";
$timm ="";
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


<h1><b><u>Meteoria Soderfjarden</u></b></h1>

<b>Select Time and Date:</b><br><br><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
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
Format:dd.mm.yy <input type="date" name="date" value="<?php echo $date;?>">
<span class="error">* <?php echo $dateErr;?></span>
<br><br><input type="submit" name="submit" value="Submit"><br><br>
</form>
<?php
// output data
echo "<br>";
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
$con=mysqli_connect("193.166.111.8","hhaq","y7xp9ua1","meteoriihi");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$result = mysqli_query($con,"SELECT * FROM data2 WHERE Date='$date' AND (LEFT(Time, 2))='$timm'");

while($row = mysqli_fetch_array($result))
  {
  echo $row['Temperature'];
  $temp[$j] = $row['Temperature'];
  $temp1[$j] = floatval($temp[$j]);
  echo " " . $row['Pressure'];
  $press[$j] = $row['Pressure'];
  $press1[$j] = floatval($press[$j]);
  echo " " . $row['Humidity'];
  $hum[$j] = $row['Humidity'];
  $hum1[$j]= floatval($hum[$j]);
  $dir[$j] = $row['Wind_direction'];
  $dir[$j]= floatval($dir[$j]);
  $htt[$j] = $row['Heating_temperature'];
  $htt[$j]= floatval($htt[$j]);
  echo " " . $row['Date'];
  $dat[$j] = $row['Date'];
  echo " " . $row['Time'];
  $tim[$j] = $row['Time'];
  echo "<br>";
  $j++;
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
}
?>

</body>
</html>

