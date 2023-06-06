
<?php

$username="only_owner";
$password="56IC%.ww9Dv3";
$database="covid_portal";
$con=mysqli_connect('localhost',$username,$password,$database) or die("Connection Failed". mysqli_connect_error());

$user=$_REQUEST["user"];
$pass=$_REQUEST["pass"];


$query  = "SELECT username,password FROM credentials WHERE username='$user' AND password='$pass'";
$result = mysqli_query($con,$query);

if(mysqli_num_rows($result)==0)
{
	echo 0;
}
else
{
	echo 1;
}


?>

