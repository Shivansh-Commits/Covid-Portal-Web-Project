<?php 
$user =  $_REQUEST["user"];
$pass = $_REQUEST["pass"];
$email = $_REQUEST["email"];


$username="only_owner";
$password="56IC%.ww9Dv3";
$database = "covid_portal";
$con=mysqli_connect('localhost',$username,$password,$database) or die("Connection Failed". mysqli_connect_error());

mysqli_query($con,"INSERT INTO credentials( username , password , email) VALUES ('$user', '$pass' , '$email') ");

	echo "1";



?>