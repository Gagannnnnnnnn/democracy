<html>
<body>
<?php

$dbh=mysqli_connect('localhost','root','') or die(mysqli_error());
mysqli_select_db($dbh,'india')or die(mysqli_error());
$username=$_POST['username'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$village=$_POST['village'];
$district=$_POST['district'];
$taluk=$_POST['taluk'];



$query="INSERT INTO user_details VALUES ('$username','$email','$phone','$village','$district','$taluk')";
$result=mysqli_query($dbh,$query)or die(mysqli_error($dbh));


TODO:
header("Location:complaint.html");
exit
 
?>
</body>
</html>
