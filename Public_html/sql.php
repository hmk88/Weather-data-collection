 <?php
$con=mysqli_connect("localhost","root","asd123","test");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
else
{
echo "Connected";
}

mysqli_close($con);
?>

